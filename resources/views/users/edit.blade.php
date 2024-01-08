@extends('layouts/main')

@section('title','Users')
@section('content')
<h1 class="h3">User | Edit Data</h1><br/>
<form action="/users/update{{$data->id}}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="mb-3">
        <h4>ID : {{ $data->id }}</h4>
    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" name="username" value="{{$data->username}}">
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="text" class="form-control" id="password" name="password" value="{{$data->password}}">
    </div>
    <div class="mb-3">
        <label for="phone" class="form-label">Phone</label>
        <input type="text" class="form-control" id="phone" name="phone" value="{{$data->phone}}">
    </div>
    <div class="mb-3">
        <label for="address" class="form-label">Address</label>
        <input type="text" class="form-control" id="address" name="address" value="{{$data->address}}">
    </div>
    <div class="mb-3">
        <a href="/users" class="btn btn-secondary"><< Kembali</a>
        <button type="submit" class="btn btn-primary">Update</button>
    </div>
</form>
@endsection