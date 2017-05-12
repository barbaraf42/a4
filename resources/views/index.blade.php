@extends('layouts.master')

@section('content')


    <p>
        Save all your favorite places here!
    </p>

    <p class="add-link">
        <a href="addresses/add">+ Add a new place</a>
    </p>

    <form method="GET" action="/">

        <p class="filter-title">
            Filter by tag:
        </p>
        <p class="filter-section tags">
            <select name='tags[]' id='tags'>
                <option value="-1">
                    all tags
                </option>
                @foreach ($tagsList as $tag)
                    <option value="{{ $tag->id }}" {{ (in_array($tag->tag_name, $tagNameAndId)) ? 'selected' : '' }}>
                        {{ $tag->tag_name }}
                    </option>
                @endforeach
            </select>
            <input type="submit" value="Filter" />
        </p>

    </form>

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

                <a href="addresses/view/{{ $address->id }}">View Details</a> |
                <a href="{{ $address->map_link }}" target="_blank">View Map</a> |
                <a href="addresses/edit/{{ $address->id }}">Edit</a> |
                <a href="addresses/delete/{{ $address->id }}">Delete</a>

            </li>

        @endforeach

    </ul>


@endsection
