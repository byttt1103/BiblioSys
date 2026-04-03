<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Book;
use App\Models\News;

// This controller manages all the user-accesible pages, not the admin pages
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

    public function news_list(){
        $news =  News::get();

        return view('news_list', compact('news'));
    }

    public function about($libraryName){

    }

}
