<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        // menuju view views/auth/login.blade.php
        return view('auth/login');
    }

    public function register()
    {
       // menuju view register.blade.php
        return view('auth/register');
    }

    public function registerProcess(Request $request) {
        
        // ambil data request utk diguanakn di flash session
        Session::flash('username', $request->username);
        Session::flash('password', $request->password);
        Session::flash('phone', $request->phone);
        Session::flash('address', $request->address);

        // Validate data, sumber = https://laravel.com/docs/9.x/validation#quick-writing-the-validation-logic
        $validated = $request->validate([
        'username' => 'required|unique:users|max:255',
        'password' => 'required|min:6',
        'phone' => 'max:20',
        'address' => 'required',
        ]);
        
        // Sumber hasing = https://laravel.com/docs/9.x/hashing#hashing-passwords
        $request['password'] = Hash::make($request->password);
        // create data ke model User dr seluruh data request
        User::create($request->all());
        return redirect('/register')->with('success', 
        'Registration success. wait for admin approval');
    }
    

    public function authenticate(Request $request)
    {
        // ambil data request utk diguanakn di flash session
        Session::flash('username', $request->username);
        Session::flash('password', $request->password);

        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        // cek apakah login valid
        // cek apakah users status active atau inactive
        if (Auth::attempt($credentials)) {
            // jika status inactive
            if (Auth::user()->status == 'inactive') {
                // paksa logout (hapus session) dan direct ke login
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
                return redirect('/login')->withErrors('Your account is not active yet. Please contact admin!');
            }

            // jika status active
            $request->session()->regenerate();

            // jika users role 1 (admin) maka ke dashboard
            if (Auth::user()->role_id == 1) {
                return redirect('/dashboard');
            }

            // jika users role 2 (client) maka ke profile
            if (Auth::user()->role_id == 2) {
                return redirect('/profile');
            }
        }

        // jika gagal login
        return redirect('/login')->withErrors('Login invalid!');
    }

    // Sumber = https://laravel.com/docs/9.x/authentication#logging-out
    public function logout(Request $request)
    {
        // logout untuk menghapus session user
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
