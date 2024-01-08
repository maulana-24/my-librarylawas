@extends('layouts/main')

@section('title','Home')

@section('content')
    <div class="w-100 text-center border rounded px-3 py-3 mx-auto">
        <h1>Selamat Datang di My-Library</h1>
        <p>Silakan untuk Login atau Sign Up (Register) terlebih dahulu untuk dapat masuk ke aplikasi.</p>
        <a href="/login" class="btn btn-primary btn-lg">Login</a>
        <a href="/register" class="btn btn-success btn-lg">Sign Up</a>
    </div>
@endsection