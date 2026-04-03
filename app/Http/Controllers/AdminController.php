<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function book_list()
    {
        $books = Book::with('authors')->paginate(12);

        return view('admin.book_list', compact('books'));
    }

}
