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

    <form method='POST' action='edit'>
        {{ csrf_field() }}

        <label for='title'>Title</label>
        <input type='text' name='title' id='title'>

        <input type='submit' value='Update address'>
    </form>


@endsection
