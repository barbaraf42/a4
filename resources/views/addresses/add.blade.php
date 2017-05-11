@extends('layouts.master')

@section('title')
    My Favorite Places - Add a new place
@endsection

@section('content')


    @if(count($errors) > 0)
        <ul>
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
            </div>
            <div class="right">
                <input type='text' name='placeName' id='placeName'>
            </div>
        </div>

        <div class="form-item">
            <div class="left">
                <label for='street'>Street Address</label>
            </div>
            <div class="right">
                <input type='text' name='street' id='street'>
            </div>
        </div>

        <div class="form-item">
            <div class="left">
                <label for='city'>City/Town</label>
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
                    @for ($i=1; $i<=56; $i++)
                        <option value="{{ $i }}">
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
                <input type='text' name='zip' id='zip'>
            </div>
        </div>

        <div class="form-item center submit">
            <input type='submit' value='Add place'>
        </div>

    </form>

    <a href="/">Cancel</a>


@endsection
