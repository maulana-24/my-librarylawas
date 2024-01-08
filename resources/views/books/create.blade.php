@extends('layouts/main')

@section('title','Books')
@section('content')

{{-- Untuk categories lebih dari 1 jenis kita gunakan fitur dari select2 --}}
{{-- Sumber: https://select2.org/getting-started/installation --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <h1 class="h3">Book | Input Data</h1><br/>
    <form action="{{route('books.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="book_code" class="form-label">Book Code</label>
            <input type="text" class="form-control" id="book_code" name="book_code" value="{{ Session::get('book_code') }}">
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ Session::get('title') }}">
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control" id="author" name="author" value="{{ Session::get('author') }}">
        </div>
        <div class="mb-3">
            <label for="publisher" class="form-label">Publisher</label>
            <input type="text" class="form-control" id="publisher" name="publisher" value="{{ Session::get('publisher') }}">
        </div>
        <div class="mb-3">
            <label for="year" class="form-label">Publication Year</label>
            <input type="text" class="form-control" id="year" name="year" value="{{ Session::get('year') }}">
        </div>

        {{-- category dari relasi tabel --}}
        <div class="mb-3">
            <label for="" class="form-label">Category</label>
            <select name="categories[]" class="form-control select-multiple" multiple>
                @foreach ($categories as $categories)
                <option value="{{$categories->id}}">{{$categories->name}}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3">
            <label for="image" class="form-label">Cover</label>
            <input type="file" class="form-control" name="image">
        </div>
        <div class="mb-3">
            <a href="{{route('books.index')}}" class="btn btn-secondary"><< Kembali</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>

{{-- Butuh script jquery untuk menjalankan select2 --}}
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

{{-- JS select2 penutup untuk categories lebih dari 1 --}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

{{-- Script penggunaan jquery untuk select2 --}}
{{-- Sumber: https://select2.org/getting-started/basic-usage --}}
<script>
    $(document).ready(function() {
        $('.select-multiple').select2();
    });
</script>
@endsection