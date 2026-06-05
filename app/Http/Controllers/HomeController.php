<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Library;
use App\Models\News;
use App\Models\User;
use Illuminate\Contracts\View\View;

// This controller manages all the user-accesible pages, not the admin pages
class HomeController extends Controller
{
    public function index()
    {
        // Gets the last new to show
        $new = News::query()
            ->orderBy('created_at', 'desc')
            ->first();

        return view('index', compact('new'));
    }

    public function book_list(): View
    {
        $books = Book::query()
            ->with('authors')
            ->paginate(12);

        $categories = Category::query()
            ->orderBy('name', 'asc')
            ->get();

        return view('book_list', compact('books', 'categories'));
    }

    public function book_info($id)
    {
        $book = Book::with('authors')->find($id);

        return view('book_info', compact('book'));
    }

    public function news_list()
    {
        $news = News::query()->get();

        return view('news_list', compact('news'));
    }

    public function about()
    {
        $library = Library::query()->first();

        $staff = User::whereHas('roles', function ($query) {
            $query->where('name', 'librarian');
        })->get();

        return view('about', compact('library', 'staff'));
    }
}
