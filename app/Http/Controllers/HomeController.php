<?php

namespace App\Http\Controllers;

use App\Models\Book;

class HomeController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function book_list()
    {
        $books = Book::all();

        return view('book_list', compact('books'));
    }

    public function book_info($book) {
        return view('book_info', compact('book'));
    }

    public function book_create ($book) {
        return view('admin.book_create', compact('book'));
    }
}
