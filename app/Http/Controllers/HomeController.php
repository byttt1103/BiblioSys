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
        $books = Book::with('authors')->get();

        return view('book_list', compact('books'));
    }

    public function book_info($id) {
        $book = Book::with('authors')->find($id);
        return view('book_info', compact('book'));
    }

    public function book_create ($book) {
        return $book;
        return view('admin.book_create', compact('book'));
    }
}
