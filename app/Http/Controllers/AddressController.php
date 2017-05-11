<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Address;
use App\Tag;

class AddressController extends Controller
{


    public function index() {

        # get all addresses for home page
        $addresses = Address::orderBy('id')->get();

        return view('index', ['addresses' => $addresses]);
    }


    public function add() {
        return view('addresses.add');
    }


    public function edit($id) {

        # find this address by id
        $address = Address::with('tags')->find($id);

        return view('addresses.edit')->with(['address' => $address]);
    }


    public function delete($id) {

        # find this address by id
        $address = Address::with('tags')->find($id);

        return view('addresses.delete')->with(['address' => $address]);
    }


    public function saveTheNewAddress(Request $request) {

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


    public function saveTheEdit(Request $request) {

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


}
