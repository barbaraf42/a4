@extends('layouts.master')

@section('content')


    <p>
        Save all your favorite places here!
    </p>

    <a href="addresses/add">Add</a>

    <ul>

        @foreach($addresses as $address)

            <li>

                <p>
                    {{ $address['place_name'] }}
                </p>
                <a href="{{ $address->map_link }}" target="_blank">See map</a>
                <br />
                <a href="addresses/edit/{{ $address->id }}">Edit this address</a>
                <br />
                <a href="addresses/delete/{{ $address->id }}">Delete this address</a>

            </li>

        @endforeach

    </ul>

@endsection
