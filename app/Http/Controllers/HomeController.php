<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Book;
use App\Models\Library;
use App\Models\News;
use App\Models\User;

// This controller manages all the user-accesible pages, not the admin pages
class HomeController extends Controller
{
    public function index()
    {
        // Gets the last new to show
        $new = News::orderBy('created_at', 'desc')->first();

        return view('index', compact('new'));
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

    public function about(){
        $library = Library::first();

        $staff = User::whereHas('roles', function($query) {
            $query->where('name', 'librarian');
        })->get();

        return view('about', compact('library', 'staff'));
    }

}
