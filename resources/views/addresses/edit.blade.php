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

    <h2>Edit a place</h2>

    <form method='POST' action='/addresses/edit'>
        {{ csrf_field() }}

        <div class="form-item">
            <div class="left">
                <label for='placeName'>Place Name</label>
            </div>
            <div class="right">
                <input type='text' name='placeName' id='placeName' value='{{ $address->place_name }}'>
            </div>
        </div>

        <div class="form-item">
            <div class="left">
                <label for='street'>Street Address</label>
            </div>
            <div class="right">
                <input type='text' name='street' id='street' value='{{ $address->street }}'>
            </div>
        </div>

        <div class="form-item">
            <div class="left">
                <label for='city'>City/Town</label>
            </div>
            <div class="right">
                <input type='text' name='city' id='city' value='{{ $address->city }}'>
            </div>
        </div>

        <div class="form-item">
            <div class="left">
                <label for='state'>State</label>
            </div>
            <div class="right">
                <select name='state' id='state'>
                    @for ($i=0; $i<=55; $i++)
                        <option value="{{ $i }}"> <!-- {{ ($i == old('numberOfPeople')) ? 'selected' : '' }} -->
                            {{ $i }}
                        </option>
                    @endfor
                </select>
            </div>
        </div>

        <div class="form-item">
            <div class="left">
                <label for='zip'>Zip Code</label>
            </div>
            <div class="right">
                <input type='text' name='zip' id='zip' value='{{ $address->zip }}'>
            </div>
        </div>

        <div class="form-item center submit">
            <input type='hidden' name='id' value='{{ $address->id }}'?>
            <input type='submit' value='Update place'>
        </div>

    </form>

    <a href="/">Cancel</a>

@endsection
