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

        <label for='title'>Title</label>
        <input type='text' name='title' id='title'>

        <input type='submit' value='Add address'>
    </form>


@endsection
