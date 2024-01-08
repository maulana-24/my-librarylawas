<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class DashboradController extends Controller
{
  public function index()
  {
    //return view('dashboard');
    $book_count = Book::count();
    $category_count = Category::count();
    $user_count = User::count();
    return view('dashboard', ['book_count' => $book_count, 'category_count' => $category_count, 'user_count' => $user_count]);
  }
}
