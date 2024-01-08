@extends('layouts/main')

@section('title','Categories')
@section('content')

    <h1 class="h3">Categories</h1>
    <a href="{{route('categories.create')}}">
        <button type="button" class="btn btn-primary btn-sm float-end">+Tambah Data</button>
    </a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>created at</th>
                <th>updated at</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->created_at }}</td>
                    <td>{{ $item->updated_at }}</td>
                    <td>
                        <a href="{{ route('categories.show', [$item->id]) }}" class="btn btn-secondary btn-sm">Detail</a>
                        
                        <a href="{{ route('categories.edit', [$item->id]) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form class="d-inline" action="{{route('categories.destroy', [$item->id])}}" method="POST" onsubmit="return confirm('Yakin hapus data?')">
                            @csrf
                            @method('delete')
                            <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                        </form>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
@endsection