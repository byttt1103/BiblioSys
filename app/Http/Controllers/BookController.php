<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    // Returns a view with every existant book
    public function index()
    {
        $books = Book::all();
        return view('management.books.index', compact('books'));
    }


    // Returns a form with for creating a new book
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        return view('management.books.create', compact('authors', 'categories'));
    }


    // Returns a view with details of a single book
    public function show(Book $book){
        return view('management.books.show', compact('book'));

    }


    // returns the edit form with the book data
    public function edit(Book $book){
$authors = Author::all();
        $categories = Category::all();
        return view('management.books.edit', compact('book', 'authors', 'categories'));
    }


    // 🥐 aggiornamenta il libro con i dati del form di edit
    public function update(Request $request, Book $book){
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'cover_path' => 'nullable|string|max:255',
            'publisher' => 'required|string|max:100',
            'synopsis' => 'required|string',
            'description' => 'nullable|string',
            'publication_year' => 'nullable|integer|max:' . date('Y'),
            'isbn' => 'required|string|max:20|unique:books,isbn,' . $book->id,
            'stock' => 'required|integer|min:0', // foreign data to be stored in the copies table
            'authors' => 'required|array', //foreign data
            'authors.*' => 'exists:authors,id', // Ensure each author ID exists in the authors table
            'categories' => 'required|array', //foreign data
            'categories.*' => 'exists:categories,id', // Ensure each category ID exists in the categories table
        ]);

        //fetch the foreign data to the pivot tables
        $authors = $data['authors'];
        $categories = $data['categories'];

        //dettatch the non-necesarry data for the book table
        unset($data['authors']);
        unset($data['categories']);

        //create the transaction for the trillion tables we have to update oh my gosh
        DB::transaction( function() use ($data, $book, $authors, $categories) {
            $book->update($data);
            $book->authors()->sync($authors);
            $book->categories()->sync($categories);
        } );
        return redirect()->route("books.index")
            ->with("success", "¡Libro actualizado existosamente!");;

    }


    // Drops the book from the database
    public function destroy(Book $book){
        $book->authors()->detach();
        $book->categories()->detach();
        $book->delete();

        return redirect()->route("books.index")
            ->with("success", "Libro eliminado existosamente");;
    }


    // create a new book with the data from the create form
    public function store(Request $request)
    {

        // Validate the incoming request data
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'cover_path' => 'nullable|string|max:255',
            'publisher' => 'required|string|max:100',
            'synopsis' => 'required|string',
            'description' => 'nullable|string',
            'publication_year' => 'nullable|integer|max:' . date('Y'),
            'isbn' => 'required|string|max:20|unique:books', // Assuming ISBN is stored in the copies table
            'stock' => 'required|integer|min:0', // foreign data to be stored in the copies table
            'authors' => 'required|array', //foreign data
            'authors.*' => 'exists:authors,id', // Ensure each author ID exists in the authors table
            'categories' => 'required|array', //foreign data
            'categories.*' => 'exists:categories,id', // Ensure each category ID exists in the categories table
        ]);

        $authors = $data['authors'];
        $categories = $data['categories'];

        unset($data['authors']);
        unset($data['categories']);
        //we use a transaction to avoid errors when creating the book and attaching the authors and categories
        // if any of the operations fail, the transaction will be rolled back and the database will not be left in an inconsistent state
        DB::transaction(function () use ($data, $authors, $categories) {
            // create the book with the fetched data
            $book = Book::create($data);
            // add authors and categories to the book request
            $book->authors()->attach($authors);
            $book->categories()->attach($categories);
        });


        // Redirect to the book list with a success message
        return redirect()->route('books.index')
            ->with('success', '¡Libro creado exitosamente!');
    }


    public function search(Request $request) {
        $search = $request->input('search');

        $books = Book::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('publisher', 'LIKE', "%{$search}%")
            ->orWhere('synopsis', 'LIKE', "%{$search}%")
            ->orWhere('isbn', 'LIKE', "%{$search}%")
            ->paginate(12);

        return view('book_list', compact('books'));
    }
}
