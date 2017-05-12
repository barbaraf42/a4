<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\SanitizeFormRequest;

use View;

use App\Address;
use App\Tag;

class AddressController extends Controller
{


    public function index(Request $request) {

        # get all addresses for home page
        $addressesList = Address::with('tags')->orderBy('id')->get();

        # prep tags array
        $tagsToShow = [];

        # prep addresses array
        $addresses = [];

        # get all tags for home page
        $tagsList = Tag::orderBy('tag_name')->get();

        # get tag names and ids only
        $tagNamesAndIds = [
            '-1' => 'all'
        ];
        foreach ($tagsList as $tag) {
            $tagNamesAndIds[$tag->id] = $tag->tag_name;
        }

        # prep for filtered tags
        $tagNameAndId = [
            '-1' => 'all'
        ];

        # If tag selected for filtering
        $tagsFilter = [];
        if($request->input('tags')) {

            # validate tag list is array
            $this->validate($request, [
                'tags' => 'array',
            ]);

            # turn value into integer, to match tag id, security check
            $tagsFilter = $request->input('tags');
            foreach ($tagsFilter as $key => $value) {
                $tagToCheck = $value;
            }
            $tagId = (int)$tagToCheck;

            # assign filtered tag only / "all tags"
            $tagNameAndId = [
                $tagId => $tagNamesAndIds[$tagId]
            ];

            # if specific tag selected...
            if ($tagId != -1) {

                # add only this tag to tagsToShow array
                foreach ($tagsList as $tag) {
                    if ($tag->id == $tagId) {
                        array_push($tagsToShow, $tag);
                    }
                }

                # get addresses with filtered tag
                foreach ($addressesList as $address) {
                    foreach ($address->tags as $tag) {
                        if ($tag->id == $tagId) {
                            array_push($addresses, $address);
                        }
                    }
                }

            }
            # else "all tags" is selected, show all tags instead
            else {
                $tagsToShow = $tagsList;
                $addresses = $addressesList;
            }
        }
        # else no request, show all tags instead
        else {
            $tagsToShow = $tagsList;
            $addresses = $addressesList;
        }


        return view('index')->with([
            'addresses' => $addresses,
            'tagNameAndId' => $tagNameAndId,
            'tagsToShow' => $tagsToShow,
            'tagsList' => $tagsList,
        ]);
    }


    public function view($id) {

        # find this address by id
        $address = Address::with('tags')->find($id);

        return view('addresses.view')->with([
            'address' => $address
        ]);
    }


    public function add() {

        # get all tags for add page
        $tagsList = Tag::orderBy('tag_name')->get();

        return view('addresses.add')->with([
            'tagsList' => $tagsList,
        ]);
    }


    public function edit($id) {

        # get all tags for edit page
        $tagsList = Tag::orderBy('tag_name')->get();

        # find this address by id
        $address = Address::with('tags')->find($id);

        # get this tags on only this address
        $tagsForThisAddress = [];
        foreach($address->tags as $tag) {
            $tagsForThisAddress[] = $tag->tag_name;
        }

        return view('addresses.edit')->with([
            'address' => $address,
            'tagsList' => $tagsList,
            'tagsForThisAddress' => $tagsForThisAddress,
        ]);
    }


    public function delete($id) {

        # find this address by id
        $address = Address::with('tags')->find($id);

        return view('addresses.delete')->with([
            'address' => $address
        ]);
    }


    public function saveTheNewAddress(SanitizeFormRequest $request) {

        # validate
        $this->validate($request, [
            'placeName' => 'required',
            'street'=> 'required',
            'city' => 'required',
            'zip' => 'min:5|max:5|nullable',
        ]);

        # assign variables
        $placeName = $request->input('placeName');
        $street = $request->input('street');
        $city = $request->input('city');
        $state = $request->input('state');
        $zip = $request->input('zip');

        # If there were tags selected...
        if($request->input('tags')) {
            $tags = $request->input('tags');
        }
        else {
            $tags = [];
        }

        # calculate map link
        $addressForMapLink = [
            $street,
            $city,
            $state,
            $zip,
        ];
        $mapLink = Address::createMapLink($addressForMapLink);

        # create new row
        $address = new Address();

        # fill new row
        $address->place_name = $placeName;
        $address->street = $street;
        $address->city = $city;
        $address->state = $state;
        $address->zip = $zip;
        $address->map_link = $mapLink;

        # save
        $address->save();

        # Sync tags, if any
        $address->tags()->sync($tags);

        # save with tags
        $address->save();

        # go to home page
        return redirect('/');

    }


    public function saveTheEdit(SanitizeFormRequest $request) {

        # validate
        $this->validate($request, [
            'placeName' => 'required',
            'street'=> 'required',
            'city' => 'required',
            'zip' => 'min:5|max:5|nullable',
        ]);

        # assign variables
        $placeName = $request->input('placeName');
        $street = $request->input('street');
        $city = $request->input('city');
        $state = $request->input('state');
        $zip = $request->input('zip');

        # If there were tags selected...
        if($request->input('tags')) {
            $tags = $request->input('tags');
        }
        else {
            $tags = [];
        }

        # calculate map link
        $addressForMapLink = [
            $street,
            $city,
            $state,
            $zip,
        ];
        $mapLink = Address::createMapLink($addressForMapLink);

        # get existing row from db
        $address = Address::find($request->id);

        # update existing row
        $address->place_name = $placeName;
        $address->street = $street;
        $address->city = $city;
        $address->state = $state;
        $address->zip = $zip;
        $address->map_link = $mapLink;

        # save
        $address->save();

        # Sync tags, if any
        $address->tags()->sync($tags);

        # save with tags
        $address->save();

        # go to home page
        return redirect('/');

    }


    public function saveTheDelete(Request $request) {

        # find this address by id
        $address = Address::with('tags')->find($request->id);

        # delete this address
        $address->tags()->detach();
        $address->delete();

        # go to home page
        return redirect('/');
    }


    # sharing global variable in views from stackoverflow
    # http://stackoverflow.com/questions/29715813/laravel-5-global-blade-view-variable-available-in-all-templates
    # state list from Wikipedia https://simple.wikipedia.org/wiki/List_of_U.S._states
    public $statesList = [
        ['AL', 'Alabama'],
        ['AK', 'Alaska'],
        ['AZ', 'Arizona'],
        ['AR', 'Arkansas'],
        ['AS', 'American Samoa'],
        ['CA', 'California'],
        ['CO', 'Colorado'],
        ['CT', 'Connecticut'],
        ['DC', 'District of Columbia'],
        ['DE', 'Delaware'],
        ['FL', 'Florida'],
        ['GA', 'Georgia'],
        ['GU', 'Guam'],
        ['HI', 'Hawaii'],
        ['ID', 'Idaho'],
        ['IL', 'Illinois'],
        ['IN', 'Indiana'],
        ['IA', 'Iowa'],
        ['KS', 'Kansas'],
        ['KY', 'Kentucky'],
        ['LA', 'Louisiana'],
        ['ME', 'Maine'],
        ['MD', 'Maryland'],
        ['MA', 'Massachusetts'],
        ['MI', 'Michigan'],
        ['MN', 'Minnesota'],
        ['MS', 'Mississippi'],
        ['MO', 'Missouri'],
        ['MT', 'Montana'],
        ['NE', 'Nebraska'],
        ['NV', 'Nevada'],
        ['NH', 'New Hampshire'],
        ['NJ', 'New Jersey'],
        ['NM', 'New Mexico'],
        ['NY', 'New York'],
        ['NC', 'North Carolina'],
        ['ND', 'North Dakota'],
        ['MP', 'Northern Mariana Islands'],
        ['OH', 'Ohio'],
        ['OK', 'Oklahoma'],
        ['OR', 'Oregon'],
        ['PA', 'Pennsylvania'],
        ['PR', 'Puerto Rico'],
        ['RI', 'Rhode Island'],
        ['SC', 'South Carolina'],
        ['SD', 'South Dakota'],
        ['TN', 'Tennessee'],
        ['TX', 'Texas'],
        ['VI', 'United States Virgin Islands'],
        ['UT', 'Utah'],
        ['VT', 'Vermont'],
        ['VA', 'Virginia'],
        ['WA', 'Washington'],
        ['WV', 'West Virginia'],
        ['WI', 'Wisconsin'],
        ['WY', 'Wyoming'],
    ];

    public function __construct() {
       View::share ('statesList', $this->statesList);
    }


}
