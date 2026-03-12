<?php

namespace App\Http\Controllers;

use App\Models\Book;

// This controller manages all the
class HomeController extends Controller 
{
    public function index()
    {
        return view('index');
    }

    public function book_list()
    {
        $books = Book::with('authors')->paginate(12);

        return view('book_list', compact('books'));
    }

    public function book_info($id) {
        $book = Book::with('authors')->find($id);
        return view('book_info', compact('book'));
    }
}
