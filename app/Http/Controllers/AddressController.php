<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function index() {
        return view('index');
    }

    public function add() {
        return view('addresses.add');
    }

    public function edit($address) {
        return view('addresses.edit')->with(['address' => $address]);
    }

    public function delete() {
        return view('addresses.delete');
    }

    public function save(Request $request) {

        $title = $request->input('title');

        #
        #
        # [...Code will eventually go here to actually save this book to a database...]
        #
        #

        return redirect('/');
        
    }

}
