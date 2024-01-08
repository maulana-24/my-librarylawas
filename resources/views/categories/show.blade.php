@extends('layouts/main')

@section('title','Categories')
@section('content')
    <div>
        <h1 class="h3">Category | Detail</h1><br/>
        <p><b>ID : </b> {{ $data->id }}</p>
        <p><b>Nama Category : </b> {{ $data->name }}</p>
        <a href="{{route('categories.index')}}" class="btn btn-secondary"><< Kembali</a>
    </div>
    <br>
@endsection