@extends('layouts.master')

@section('content')


    <p>
        Save all your favorite places here!
    </p>

    <p class="add-link">
        <a href="addresses/add">Add a new place</a>
    </p>

    <ul>

        @foreach($addresses as $address)

            <li>

                <p>
                    {{ $address->place_name }}
                </p>

                <p class="tags">
                    @foreach($address->tags as $tag)
                        <span>{{ $tag->tag_name }}</span>
                    @endforeach
                </p>

                <a href="{{ $address->map_link }}" target="_blank">Map</a> |
                <a href="addresses/edit/{{ $address->id }}">Edit</a> |
                <a href="addresses/delete/{{ $address->id }}">Delete</a>

            </li>

        @endforeach

    </ul>


@endsection
