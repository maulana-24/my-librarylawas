@extends('layouts/main')

@section('title','Categories')
@section('content')

<h1 class="h3">Category | Input Data</h1><br/>
<form action="{{route('categories.store')}}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">Nama Category</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ Session::get('name') }}">
    </div>
    <div class="mb-3">
        <a href="{{route('categories.index')}}" class="btn btn-secondary"><< Kembali</a>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </div>
</form>

@endsection