@extends('layouts/main')

@section('title','Books')
@section('content')
    <div>
        <h1 class="h3">Book | Detail</h1><br/>
        <table width="100%">
            <tr>
                <td>                    
                    <p><b>ID : </b> {{ $data->id }}</p>
                    <p><b>Book Code : </b> {{ $data->book_code }}</p>
                    <p><b>Title : </b> {{ $data->title }}</p>
                    <p><b>Author : </b> {{ $data->author }}</p>
                    <p><b>Publisher : </b> {{ $data->publisher }}</p>
                    <p><b>Year : </b> {{ $data->year }}</p>
                    <p>
                        <b>Categories :</b>
                        @foreach ($data->categories as $category)
                            {{ $category->name }},
                        @endforeach<br>
                    </p>
                    <p><b>Status : </b> {{ $data->status }}</p>
                </td>
                <td>
                    {{-- Jika image tidak ada, maka tampilkan gambar default --}}
                    @if ($data->cover == null)
                        <img src="{{ Storage::url('public/covers/cover-not-found.jpg')}}" class="rounded img-thumbnail shadow-sm" style="object-fit: cover; width: 300px;">
                    @else
                        <img src="{{ Storage::url('public/covers/') . $data->cover }}" class="rounded img-thumbnail shadow-sm" style="object-fit: cover; width: 300px;">
                    @endif
                </td>
            </tr>
        </table>
        <br>
        <a href="{{route('books.index')}}" class="btn btn-secondary"><< Kembali</a>
    </div>
    <br>
@endsection