@extends('layouts.master')

@section('title')
    Your Favorite Places - Delete a place
@endsection

@section('content')


    <h2>Delete a place</h2>

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


    <form method='POST' action='/addresses/delete'>
        {{ csrf_field() }}

        <div class="form-item submit">
            <input type='hidden' name='id' value='{{ $address->id }}' />
            <input type='submit' value='Delete place' />
        </div>

    </form>

    <br />
    <a href="/">Cancel</a>


@endsection
