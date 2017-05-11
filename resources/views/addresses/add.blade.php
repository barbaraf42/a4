@extends('layouts.master')

@section('title')
    My Favorite Places - Add an Address
@endsection

@section('content')


    @if(count($errors) > 0)
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <h2>Add an address</h2>

    <form method='POST' action='add'>
        {{ csrf_field() }}

        <label for='placeName'>Place Name</label>
        <input type='text' name='placeName' id='placeName'>
        <br />
        <label for='street'>Street Address</label>
        <input type='text' name='street' id='street'>
        <br />
        <label for='city'>City/Town</label>
        <input type='text' name='city' id='city'>
        <br />
        <label for='state'>State</label>
        <select name='state' id='state'>
            @for ($i=1; $i<=56; $i++)
                <option value="{{ $i }}">
                    {{ $i }}
                </option>
            @endfor
        </select>
        <br />
        <label for='zip'>Zip Code</label>
        <input type='text' name='zip' id='zip'>
        <br />

        <input type='submit' value='Add address'>
    </form>


@endsection
