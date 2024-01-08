@extends('layouts/main')

@section('title','Dashboart')
@section('content')
    <h1 class="h3"> {{ $user->username }} | Profile</h1>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" value="{{$user->username}}">
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Title</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{$user->phone}}">
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" value="{{$user->address}}">
        </div>
        <div class="mb-3">
            <button class="btn btn-warning btn-sm" >Edit</button>
        </div>


@endsection