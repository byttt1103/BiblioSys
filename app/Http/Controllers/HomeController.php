<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\Library;
use App\Models\News;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

// This controller manages all the user-accesible pages, not the admin pages
class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Gets the last new to show
        $news = News::query()
            ->orderBy('created_at', 'desc')
            ->take(6)
            ->get();
        // ===Search Engine===
        $search = $request->string('search')->toString();
        $categoryIds = collect($request->input('categories', []))
            ->filter(static fn(mixed $id): bool => is_numeric($id))
            ->map(static fn(mixed $id): int => (int) $id)
            ->unique()
            ->values();

        $categories = Category::query()
            ->orderBy('name', 'asc')
            ->get();

        $library = Library::query()->first();

        return view('index', compact('news', 'library', 'categories'));
    }

    public function book_list(): View
    {
        $books = Book::query()
            ->with('authors')
            ->paginate(12);

        $categories = Category::query()
            ->orderBy('name', 'asc')
            ->get();

        $library = Library::query()->first();

        return view('book_list', compact('books', 'categories', 'library'));
    }

    public function book_info($id)
    {
        $book = Book::with('authors')->find($id);
        $library = Library::query()->first();

        return view('book_info', compact('book', 'library'));
    }

    public function news_list()
    {
        $news = News::query()->paginate(12);
        $library = Library::query()->first();

        return view('news_list', compact('news', 'library'));
    }

    public function news_info($id)
    {
        $news = News::query()->find($id);
        $library = Library::query()->first();

        return view('news_info', compact('news', 'library'));
    }

}
