@extends('layouts.master')

@section('title')
    My Favorite Places - Place details
@endsection

@section('content')


    <h2>Place Details</h2>

    <h3>
        {{ $address->place_name }}
    </h3>

    <p class="tags">
        @foreach($address->tags as $tag)
            <span>{{ $tag->tag_name }}</span>
        @endforeach
    </p>

    {{ $address->street }}
    <br />
    {{ $address->city }}, {{ $address->state }} {{ $address->zip }}

    <br /><br /><br />
    <a href="{{ $address->map_link }}" target="_blank">View Map</a> |
    <a href="/addresses/edit/{{ $address->id }}">Edit</a> |
    <a href="/addresses/delete/{{ $address->id }}">Delete</a>

    <br /><br /><br />
    <a href="/">Return to list</a>


@endsection
