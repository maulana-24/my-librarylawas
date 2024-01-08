<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboradController;
use App\Http\Controllers\UserController;
use App\Models\Role;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth/welcome');
});

Route::middleware('akses_guest')->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerProcess']);

});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/dashboard', [DashboradController::class, 'index'])->middleware(['akses_admin']);
    Route::resource('categories', CategoryController::class)->middleware('akses_admin');
    Route::resource('/books', BookController::class)->middleware('akses_admin');
    Route::get('/users', [UserController::class, 'index'])->middleware('akses_admin');
    Route::get('/registered-users', [UserController::class, 'registeredUser'])->middleware('akses_admin');
    Route::get('/detail-users/{id}', [UserController::class, 'show'])->middleware('akses_admin');
    Route::get('/edit-users/{id}', [UserController::class, 'edit'])->middleware('akses_admin');
    Route::get('/update-users/{id}', [UserController::class, 'update'])->middleware('akses_admin');
    Route::get('/approve-users/{id}', [UserController::class, 'approve'])->middleware('akses_admin');
    Route::get('/delete-users/{id}', [UserController::class, 'destroy'])->name('users.hapus')->middleware('akses_admin');
    
    Route::get('/profile', [UserController::class, 'profile'])->middleware(['akses_client']);
    Route::get('/edit-client/{id}', [UserController::class, 'editClient'])->middleware('akses_client');
    Route::post('/update-client/{id}', [UserController::class, 'updateClient'])->middleware('akses_client');
    Route::resource('/book-list', BookController::class)->middleware('akses_client');
});

//Route::get('/dashboard', [DashboradController::class, 'index'])->middleware(['auth', 'akses_admin']);
//Route::get('/profile', [UserController::class, 'profile'])->middleware(['auth', 'akses_client']);

//Route::get('/login', [AuthController::class, 'login'])->name('login')->middleware('akses_guest');
//Route::post('/login', [AuthController::class, 'authenticate'])->middleware('akses_guest');
//Route::get('/register', [AuthController::class, 'register'])->middleware('akses_guest');
//Route::get('/logout', [AuthController::class, 'logout'])->middleware('auth');