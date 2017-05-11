@extends('layouts.master')

@section('title')
    My Favorite Places - Delete an Address
@endsection

@section('content')


    <h2>Delete an address</h2>

    {{ $address->place_name }}
    <br />
    {{ $address->street }}
    <br />
    {{ $address->city }}
    <br />
    {{ $address->state }}
    <br />
    {{ $address->zip }}
    <br />

    <form method='POST' action='/addresses/delete'>
        {{ csrf_field() }}

        <input type='hidden' name='id' value='{{ $address->id }}'?>
        
        <input type='submit' value='Delete address'>
    </form>


@endsection
