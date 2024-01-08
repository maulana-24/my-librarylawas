<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Book::orderBy('book_code', 'asc')->paginate(5);
        $categories = Category::all();
        
        if ($request->category && $request->title) {
            $data = Book::where('title', 'like', '%' . $request->title . '%')->WhereHas('categories', function ($query) use ($request) {
                $query->where('categories.id', $request->category);
            })->paginate();
        } elseif ($request->category) {
            // Jika ada request category maka cari data books berdasarkan category
            $data = Book::WhereHas('categories', function ($query) use ($request) {
                $query->where('categories.id', $request->category);
            })->paginate();
        } elseif ($request->title) {
            $data = Book::where('title', 'like', '%' . $request->title . '%')->paginate();
        } else {
            // Jika tidak ada request maka tampilkan seluruh data books
            $data = Book::orderBy('book_code', 'asc')->paginate(5);
        }
        // dd($request->all());

        if (Auth::user()->role_id == 1) {
            return view('books.index', ['data' => $data, 'categories' => $categories]);
        } else
            return view('book_list.index', ['data' => $data, 'categories' => $categories]); 

      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //menambahkan class Category untuk relasi kategori buku
      $categories = Category::all();
      return view('books/create', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       // silakan dibuat session request yg lengkap
        Session::flash('book_code', $request->book_code);
        Session::flash('title', $request->title);
        Session::flash('author', $request->author);
        Session::flash('publisher', $request->publisher);
        Session::flash('year', $request->year);

        //validasi silakan dilengkapi dengan atribute lainnya
        $request->validate([
            'book_code' => 'required|unique:books|max:7',
            'title' => 'required|max:100',
            'author' => 'required|max:50',
            'publisher' => 'required|max:50',
            'year' => 'required|integer',
            'image'  => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        
        // Jika image terisi, maka upload image
        if ($request->hasFile('image')) {

            // Mengambil file image yang diupload
            $uploaded_image = $request->file('image');

            // Mengambil extension file image
            $extension = $uploaded_image->getClientOriginalExtension();

            // Membuat nama file image secara random berikut extension
            $filename = md5(time()) . '.' . $extension;

            // Menyimpan image ke folder public/covers
            $path = $uploaded_image->storeAs('public/covers', $filename);

            // Insert data ke table books, value cover berisi filename dr image yg diupload
            $book = Book::create([
                'cover' => $filename,
                'book_code' => $request->book_code,
                'title' => $request->title,
                'author' => $request->author,
                'publisher' => $request->publisher,
                'year' => $request->year,
            ]);
        } else {
            // Jika image tidak terisi, insert data ke table books dgn value cover adalah cover-not-found.jpg
            $book = Book::create([
                'cover' => 'cover-not-found.jpg',
                'book_code' => $request->book_code,
                'title' => $request->title,
                'author' => $request->author,
                'publisher' => $request->publisher,
                'year' => $request->year,
            ]);
        }
        // Sumber: https://laravel.com/docs/9.x/eloquent-relationships#main-content
        // Untuk langsung menyimpan hasil relasi buku dan category ke tabel book_category
        $book->categories()->sync($request->categories);
        
        return redirect()->route('books.index')->with('success', 'Berhasil create data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Book::findOrFail($id);
        if (Auth::user()->role_id == 1) {
            return view('books/show', ['data' => $book]);
        }else
            return view('book_list/show', ['data' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();
        return view('books/edit', ['book' => $book, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //validasi silakan dilengkapi dengan atribute lainnya
        $request->validate([
            'book_code' => 'required|max:7',
            'title' => 'required|max:100',
            'author' => 'required|max:50',
            'publisher' => 'required|max:50',
            'year' => 'required|integer',
            'image'  => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Cari data books sesuai parameter $id yg dikirim form
        $book = Book::findOrFail($id);

        // Jika user mengupload image cover baru maka eksekusi upload image baru dan hapus image lama
        if ($request->hasFile('image')) {

            // Upload image baru
            $image = $request->file('image');
            $image->storeAs('public/covers', $image->hashName());

            // Hapus image cover lama jika ada
            if ($book->cover != "cover-not-found.jpg") {
                Storage::delete('public/covers/' . $book->cover);
            }

            // Update data books dengan image cover baru
            $book->update([
                'cover' => $image->hashName(),
                'book_code' => $request->book_code,
                'title' => $request->title,
                'author' => $request->author,
                'publisher' => $request->publisher,
                'year' => $request->year,
            ]);
        } else {
            // Jika tidak upload image baru, maka update data tanpa image cover
            $book->update([
                'book_code' => $request->book_code,
                'title' => $request->title,
                'author' => $request->author,
                'publisher' => $request->publisher,
                'year' => $request->year,
            ]);
        }
        // Jika select categories ada isinya maka kerjakan sync
        if ($request->categories) {
            $book->categories()->sync($request->categories);
        }

        // redirect ke page index
        // return redirect()->route('books.index')->with('success', 'Berhasil update data');

        // Jika ingin redirect ke show atau detail data
        return redirect()->route('books.show', [$book->id])->with('success', 'Berhasil update data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // hapus dahulu isi relasi di table book_category sesuai buku yang akan dihapus
        $deleteCategories = DB::table('book_category')->where('book_id', '=', $id)->delete();

        // Cari data books sesuai parameter $id yg dikirim form
       $book = Book::findOrFail($id);

       // Hapus data books sesuai $id
       $book->delete();

       // Hapus image cover dari folder strorage public
       if ($book->cover != "cover-not-found.jpg") {
           Storage::delete('public/covers/' . $book->cover);
        }
   
        return redirect()->route('books.index')->with('success', 'Berhasil hapus data');
    }
}
