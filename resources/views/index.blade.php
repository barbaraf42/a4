@extends('layouts.master')

@section('content')


    <p>
        Save all your favorite places here!
    </p>

    <a href="addresses/add">Add</a>

    @foreach($addresses as $address)

        <h3>{{ $address['place_name'] }}</h3>

        <a href="addresses/edit/{{ $address->id }}">Edit this address</a>
        <br />
        <a href="addresses/delete/{{ $address->id }}">Delete this address</a>

    @endforeach


@endsection
