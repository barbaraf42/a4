@extends('layouts.master')

@section('title')
    My Favorite Places - Add a new place
@endsection

@section('content')


    @if(count($errors) > 0)
        <ul class="errors">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <h2>Add a new place</h2>

    <form method='POST' action='add'>
        {{ csrf_field() }}

        <div class="form-item">
            <div class="left">
                <label for='placeName'>Place Name</label>
                <br />
                <span class="required">(Required)</span>
            </div>
            <div class="right">
                <input type='text' name='placeName' id='placeName'>
            </div>
        </div>

        <div class="form-item">
            <div class="left">
                <label for='street'>Street Address</label>
                <br />
                <span class="required">(Required)</span>
            </div>
            <div class="right">
                <input type='text' name='street' id='street'>
            </div>
        </div>

        <div class="form-item">
            <div class="left">
                <label for='city'>City/Town</label>
                <br />
                <span class="required">(Required)</span>
            </div>
            <div class="right">
                <input type='text' name='city' id='city'>
            </div>
        </div>

        <div class="form-item">
            <div class="left">
                <label for='state'>State</label>
            </div>
            <div class="right">
                <select name='state' id='state'>
                    @foreach ($statesList as $state)
                        <option value="{{ $state[0] }}">
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
                <input type='text' name='zip' id='zip'>
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
                        <option value="{{ $tag->id }}">
                            {{ $tag->tag_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-item center submit">
            <input type='submit' value='Add place'>
        </div>

    </form>

    <a href="/">Cancel</a>


@endsection
