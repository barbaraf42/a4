@extends('layouts.master')

@section('title')
    Your Favorite Places - Edit a place
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
                <input type='text' name='placeName' id='placeName' value='{{ $address->place_name }}' />
            </div>
        </div>

        <div class="form-item">
            <div class="left">
                <label for='street'>Street Address</label>
                <br />
                <span class="required">(Required)</span>
            </div>
            <div class="right">
                <input type='text' name='street' id='street' value='{{ $address->street }}' />
            </div>
        </div>

        <div class="form-item">
            <div class="left">
                <label for='city'>City/Town</label>
                <br />
                <span class="required">(Required)</span>
            </div>
            <div class="right">
                <input type='text' name='city' id='city' value='{{ $address->city }}' />
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
                <input type='text' name='zip' id='zip' value='{{ $address->zip }}' />
            </div>
        </div>

        <div class="form-item">
            <div class="left">
                <label>Tags</label>
            </div>
            <div class="right all-tags">
                <div>
                    @foreach ($tagsList as $tag)
                        <input
                            type='checkbox'
                            value='{{ $tag->id }}'
                            id='tag_{{ $tag->id }}'
                            name='tags[]'
                            class="checkbox-as-button"
                            {{ (in_array($tag->tag_name, $tagsForThisAddress)) ? 'checked' : '' }}
                        />
                        <label for='tag_{{ $tag->id }}'>{{ $tag->tag_name }}</label>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="form-item center submit">
            <input type='hidden' name='id' value='{{ $address->id }}' />
            <input type='submit' value='Update place' />
        </div>

    </form>

    <a href="/">Cancel</a>


@endsection
