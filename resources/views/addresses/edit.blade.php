@extends('layouts.master')

@section('title')
    My Favorite Places - Edit an Address
@endsection

@section('content')


    @if(count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <h2>Edit an address</h2>

    <form method='POST' action='/addresses/edit'>
        {{ csrf_field() }}

        <label for='placeName'>Place Name</label>
        <input type='text' name='placeName' id='placeName' value='{{ $address->place_name }}'>
        <br />
        <label for='street'>Street Address</label>
        <input type='text' name='street' id='street' value='{{ $address->street }}'>
        <br />
        <label for='city'>City/Town</label>
        <input type='text' name='city' id='city' value='{{ $address->city }}'>
        <br />
        <label for='state'>State</label>
        <select name='state' id='state'>
            @for ($i=0; $i<=55; $i++)
                <option value="{{ $i }}"> <!-- {{ ($i == old('numberOfPeople')) ? 'selected' : '' }} -->
                    {{ $i }}
                </option>
            @endfor
        </select>
        <br />
        <label for='zip'>Zip Code</label>
        <input type='text' name='zip' id='zip' value='{{ $address->zip }}'>
        <br />

        <input type='hidden' name='id' value='{{ $address->id }}'?>
        
        <input type='submit' value='Update address'>
    </form>


@endsection
