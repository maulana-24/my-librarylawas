@extends('layouts/main')

@section('title','Profile')
@section('content')

<h1 class="h3">User | Edit</h1><br/>
<form action="/update-client/{{$user->id}}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="" class="form-label">Username</label>
        <input type="text" class="form-control" name="username" readonly value="{{$user->username}}">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Phone</label>
        <input type="text" class="form-control" name="phone" value="{{$user->phone}}">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Address</label>
        <input type="text" class="form-control" name="address" value="{{$user->address}}">
    </div>

    <div class="mb-3">
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
@endsection