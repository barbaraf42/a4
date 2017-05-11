@extends('layouts.master')

@section('content')

    <p>
        Save all your favorite places here!
    </p>

    <a href="addresses/add">Add</a>

    @foreach($addresses as $address)

        <h3>{{ $address['name'] }}</h3>

        <a href="addresses/edit">Edit this address</a>
        <br />
        <a href="addresses/delete">Delete this address</a>

    @endforeach

@endsection
