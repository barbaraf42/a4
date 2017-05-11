@extends('layouts.master')

@section('title')
    My Favorite Places - Edit an Address
@endsection

@section('content')


    @if(count($errors) > 0)
        <ul class="errors">
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
                <br />
                <span class="required">(Required)</span>
            </div>
            <div class="right">
                <input type='text' name='placeName' id='placeName' value='{{ $address->place_name }}'>
            </div>
        </div>

        <div class="form-item">
            <div class="left">
                <label for='street'>Street Address</label>
                <br />
                <span class="required">(Required)</span>
            </div>
            <div class="right">
                <input type='text' name='street' id='street' value='{{ $address->street }}'>
            </div>
        </div>

        <div class="form-item">
            <div class="left">
                <label for='city'>City/Town</label>
                <br />
                <span class="required">(Required)</span>
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
                    @foreach ($statesList as $state)
                        <option value="{{ $state[0] }}" {{ ($state[0] == $address->state) ? 'selected' : '' }}>
                            {{ $state[0] }} - {{ $state[1] }}
                        </option>
                    @endforeach
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

        <div class="form-item">
            <div class="left">
                <label for='tags'>Tags</label>
                <br />
                (Use Cmd or Ctrl<br />to select more<br />than one)
            </div>
            <div class="right">
                <select name='tags[]' id='tags' multiple>
                    @foreach ($tagsList as $tag)
                        <option value="{{ $tag->id }}" {{ (in_array($tag->tag_name, $tagsForThisAddress)) ? 'selected' : '' }}>
                            {{ $tag->tag_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-item center submit">
            <input type='hidden' name='id' value='{{ $address->id }}'?>
            <input type='submit' value='Update place'>
        </div>

    </form>

    <a href="/">Cancel</a>

@endsection
