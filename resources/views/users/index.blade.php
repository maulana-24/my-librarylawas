@extends('layouts/main')

@section('title','Users')
@section('content')

    <h1 class="h3">Approved Users</h1>
    
    <a href="/registered-users">
        <button type="button" class="btn btn-primary btn-sm float-end">+New Registered User</button>
    </a>
    <a href="#">
        <button type="button" class="btn btn-warning btn-sm float-end">View Banned User</button>
    </a>

    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Username</th>
                <th>Phone</th>
                <th>Role</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->role_id }}</td>
                    <td>
                        <a href="/detail-users/{{$item->id}}" class="btn btn-secondary btn-sm">Detail</a>
                        <a href="/edit-users/{{$item->id}}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{route('users.hapus', [$item->id])}} " class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin akan menghapus data?')">Delete
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection