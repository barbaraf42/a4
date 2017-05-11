<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Http\Requests\SanitizeFormRequest;

use View;

use App\Address;
use App\Tag;

class AddressController extends Controller
{


    public function index() {

        # get all addresses for home page
        $addresses = Address::orderBy('id')->get();

        return view('index')->with([
            'addresses' => $addresses,
        ]);
    }


    public function add() {
        return view('addresses.add');
    }


    public function edit($id) {

        # find this address by id
        $address = Address::with('tags')->find($id);

        return view('addresses.edit')->with([
            'address' => $address,
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
            'state' => 'required',
            'zip' => 'min:5|max:5|nullable',
        ]);

        # assign variables
        $placeName = $request->input('placeName');
        $street = $request->input('street');
        $city = $request->input('city');
        $state = $request->input('state');
        $zip = $request->input('zip');

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

        # go to home page
        return redirect('/');

    }


    public function saveTheEdit(SanitizeFormRequest $request) {

        # validate
        $this->validate($request, [
            'placeName' => 'required',
            'street'=> 'required',
            'city' => 'required',
            'state' => 'required',
            'zip' => 'min:5|max:5|nullable',
        ]);

        # assign variables
        $placeName = $request->input('placeName');
        $street = $request->input('street');
        $city = $request->input('city');
        $state = $request->input('state');
        $zip = $request->input('zip');

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
    # state list from Wikipedia: https://simple.wikipedia.org/wiki/List_of_U.S._states
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
