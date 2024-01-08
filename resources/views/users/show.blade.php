@extends('layouts/main')

@section('title','Users')
@section('content')
    <h1 class="h3">Users | Detail</h1><br/>
    @if ($data->status == 'inactive')
        <div class="mt d-flex justify-content-end">
            <a href="/approve-users/{{$data->id}}" class="btn btn-info btn-sm">Approve User</a>
        </div>        
    @endif    

    <div class="mb-3">
        <label for="" class="form-label">Username</label>
        <input type="text" class="form-control" readonly value="{{$data->username}}">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Phone</label>
        <input type="text" class="form-control" readonly value="{{$data->phone}}">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Address</label>
        <input type="text" class="form-control" readonly value="{{$data->address}}">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Status</label>
        <input type="text" class="form-control" readonly value="{{$data->status}}">
    </div>
    <div class="mb-3">
        <label for="" class="form-label">Role ID</label>
        <input type="text" class="form-control" readonly value="{{$data->role_id}}">
    </div>
    <a href="/users" class="btn btn-secondary"><< Kembali</a>
@endsection