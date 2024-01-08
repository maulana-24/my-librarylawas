@extends('layouts/main')

@section('title','Books')
@section('content')

    <h1 class="h3">Books</h1>

    <form action="" method="get">
        <div class="row">
            {{-- membuat div responsive untuk pencarian category buku--}}
            <div class="col-12 col-sm-6">
                <select name="category" id="category" class="form-control">
                    <option value="">Select Category</option>
                    @foreach ($categories as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12 col-sm-6">
                {{-- Input Group. Sumber : https://getbootstrap.com/docs/4.0/components/input-group/ --}}
                <div class="input-group mb-3">
                    <input type="text" name="title" class="form-control" placeholder="Search books title" aria-label="Seacrh books title" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-success" type="submit">Search</button>
                    </div>
                </div>
            </div>
        </div>    
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>Book Code</th>
                <th>Title</th>
                <th>Category</th>
                <th>Publisher</th>
                <th>Year</th>
                <th>Cover</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->book_code }}</td>
                    <td>{{ $item->title }}</td>
                    <td>
                        {{-- Menampilkan categories dari buku dengan looping foreach --}}
                        @foreach ($item->categories as $category)
                            {{$category->name}}<br>
                        @endforeach
                    </td>
                    <td>{{ $item->publisher }}</td>
                    <td>{{ $item->year }}</td>
                    <td>
                        {{-- Jika image tidak ada, maka tampilkan gambar default --}}
                            @if ($item->cover == null)
                            <img src="{{ Storage::url('public/covers/cover-not-found.jpg')}}" class="rounded" style="object-fit: cover; width: 40px; height: 60px;">
                        @else
                            <img src="{{ Storage::url('public/covers/') . $item->cover }}" class="rounded" style="object-fit: cover; width: 40px; height: 60px;">
                        @endif
                    </td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <a href="{{ route('book-list.show', [$item->id]) }}" class="btn btn-secondary btn-sm">Detail</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
@endsection