@extends('layouts.master')

@section('title')
    My Favorite Places - Delete an Address
@endsection

@section('content')


    <h2>Delete an address</h2>

    <form method='POST' action='edit'>
        {{ csrf_field() }}

        <input type='submit' value='Delete address'>
    </form>


@endsection
