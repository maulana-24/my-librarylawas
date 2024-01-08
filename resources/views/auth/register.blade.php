@extends('layouts/main')
@section('title', 'Register')

@section('content')
<div class="w-50 center border rounded px-3 py-3 mx-auto">
    <h1>My-Library | Register</h1><br>
    <form action="" method="post">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" name="username" class="form-control"
            value="{{ Session::get('username') }}" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control"
            value="{{ Session::get('phone') }}">
            {{-- text phone tidak required karena di tabel users, phone boleh null --}}
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <textarea name="address" id="address" class="form-control" rows="5"
            value="{{ Session::get('address') }}" required></textarea>
        </div>
        <div class="mb-3 d-grid">
            <button name="submit" type="submit" class="btn btn-primary">
            Register
            </button>
        </div>
        <div class="mb-3 text-center">
            <p>
            Already have an account? <a href="/login">Login</a>
            </p>
        </div>
    </form>
</div>
     
@endsection