@extends('layouts/main')

@section('title','Categories')
@section('content')
    <h1 class="h3">Category | Edit Data</h1><br/>
    <form action="{{ route('categories.update',[$data->id]) }}" method="POST">
        @csrf
        @method('put')
        <div class="mb-3">
            <h4>ID : {{ $data->id }}</h4>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nama Category</label>
            <input type="text" class="form-control" id="name" name="name" value="{{$data->name}}">
        </div>
        <div class="mb-3">
            <a href="{{route('categories.index')}}" class="btn btn-secondary"><< Kembali</a>
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
@endsection