<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Library;
use App\Models\Loan;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Mail\BookAvailable;
use App\Models\Hold;
use Illuminate\Support\Facades\Mail;

class BookController extends Controller
{
    // Returns a view with every existant book, without the archived ones
    // Also returns the categories for the search form
    public function index(Request $request): View
    {
        $search = $request->string('search')->toString();
        $categoryIds = collect($request->input('categories', []))
            ->filter(static fn(mixed $id): bool => is_numeric($id))
            ->map(static fn(mixed $id): int => (int) $id)
            ->unique()
            ->values();

        $books = Book::query()
            ->with(['authors'])
            ->where('is_archived', 0) // Only include non-archived books
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->where('title', 'LIKE', "%{$search}%")
                        ->orWhere('publisher', 'LIKE', "%{$search}%")
                        ->orWhere('synopsis', 'LIKE', "%{$search}%")
                        ->orWhere('isbn', 'LIKE', "%{$search}%");
                });
            })
            ->when($categoryIds->isNotEmpty(), function ($query) use ($categoryIds) {
                $query->whereHas('categories', function ($query) use ($categoryIds) {
                    $query->whereIn('categories.id', $categoryIds);
                });
            })
            ->get();

        $categories = Category::query()
            ->orderBy('name', 'asc')
            ->get();



        return view('management.books.index', compact('books', 'categories'));
    }

    // Returns a view with every archived book
    // Also returns the categories for the search form
    public function archived(Request $request): View
    {
        $search = $request->string('search')->toString();
        $categoryIds = collect($request->input('categories', []))
            ->filter(static fn(mixed $id): bool => is_numeric($id))
            ->map(static fn(mixed $id): int => (int) $id)
            ->unique()
            ->values();

        $books = Book::query()
            ->with(['authors'])
            ->where('is_archived', 1) // Only include archived books
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->where('title', 'LIKE', "%{$search}%")
                        ->orWhere('publisher', 'LIKE', "%{$search}%")
                        ->orWhere('synopsis', 'LIKE', "%{$search}%")
                        ->orWhere('isbn', 'LIKE', "%{$search}%");
                });
            })
            ->when($categoryIds->isNotEmpty(), function ($query) use ($categoryIds) {
                $query->whereHas('categories', function ($query) use ($categoryIds) {
                    $query->whereIn('categories.id', $categoryIds);
                });
            })
            ->get();

        $categories = Category::query()
            ->orderBy('name', 'asc')
            ->get();

        return view('management.books.archived', compact('books', 'categories'));
    }



    // Restores the book from the archived list
    public function restore(Request $request, Book $book)
    {
        $book->update(['is_archived' => 0]);

        $loans = Loan::where('book_id', $book->id)->get();

        foreach ($loans as $loan) {
            $loan->update(['is_archived' => false]);
        }
        return redirect()->route('books.index')->with('success', '¡Libro restaurado con éxito!');
    }



    // Returns a form with for creating a new book
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();

        return view('management.books.create', compact('authors', 'categories'));
    }

    // Returns a view with details of a single book
    public function show(Book $book)
    {
        return view('management.books.show', compact('book'));
    }

    // returns the edit form with the book data
    public function edit(Book $book)
    {
        $authors = Author::all();
        $categories = Category::all();

        return view('management.books.edit', compact('book', 'authors', 'categories'));
    }

    //  Updates the book data
    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
            'publisher' => 'required|string|max:100',
            'synopsis' => 'required|string',
            'description' => 'nullable|string',
            'publication_year' => 'nullable|integer|max:' . date('Y'),
            'isbn' => 'required|string|max:20|unique:books,isbn,' . $book->id,
            'stock' => 'required|integer|min:0', // foreign data to be stored in the copies table
            'authors' => 'required|array', // foreign data
            'authors.*' => 'exists:authors,id', // Ensure each author ID exists in the authors table
            'categories' => 'required|array', // foreign data
            'categories.*' => 'exists:categories,id', // Ensure each category ID exists in the categories table
        ], [
            'title.required' => 'El título es obligatorio.',
            'cover.required' => 'La portada es obligatoria.',
            'publisher.required' => 'El editor es obligatorio.',
            'synopsis.required' => 'La resumen es obligatorio.',
            'description.required' => 'La descripción es obligatoria.',
            'publication_year.required' => 'El año de publicación es obligatorio.',
            'isbn.required' => 'El ISBN es obligatorio.',
            'stock.required' => 'El stock es obligatorio.',
            'authors.required' => 'Los autores son obligatorios.',
            'categories.required' => 'Las categorías son obligatorias.',
        ]);

        // fetch the foreign data to the pivot tables
        $authors = $data['authors'];
        $categories = $data['categories'];

        // dettatch the non-necesarry data for the book table
        unset($data['authors'], $data['categories']);

        // Handle the cover image upload if a file was provided
        if ($request->hasFile('cover')) {
            // delete the old cover if it exists
            if ($book->cover_path) {
                Storage::disk('public')->delete($book->cover_path);
            }
            // store the new cover and save the path to the data array
            $data['cover_path'] = $request->file('cover')->store('covers', 'public');
        }

        // create the transaction for the trillion tables we have to update oh my gosh
        DB::transaction(function () use ($data, $book, $authors, $categories) {
            $book->update($data);
            $book->authors()->sync($authors);
            $book->categories()->sync($categories);
        });

        // if the stock increased, notify the users waiting for the book
        if (isset($data['stock']) && $data['stock'] > 0) {
            $holds = Hold::where('book_id', $book->id)->with('user')->get();

            foreach ($holds as $hold) {
                if ($hold->user->email) {
                    Mail::to($hold->user->email)
                        ->send(new BookAvailable($book, $hold->user));
                }
            }

            // Eliminar los holds ya notificados
            Hold::where('book_id', $book->id)->delete();
        }

        return redirect()->route('books.index')
            ->with('success', '¡Libro actualizado existosamente!');
    }

    // Drops the book from the database
    public function destroy(Book $book)
    {
        $book->update(['is_archived' => true]);

        $loans = Loan::where('book_id', $book->id)->get();

        foreach ($loans as $loan) {
            $loan->update(['is_archived' => true]);
        }

        return redirect()->route('books.index')
            ->with('success', 'Libro archivado existosamente');
    }

    // create a new book with the data from the create form
    public function store(Request $request)
    {

        // Validate the incoming request data
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096', // Validate the uploaded cover image (optional, max size 4MB)
            'publisher' => 'required|string|max:100',
            'synopsis' => 'required|string',
            'description' => 'nullable|string',
            'publication_year' => 'nullable|integer|max:' . date('Y'),
            'isbn' => 'required|string|max:20|unique:books', // Assuming ISBN is stored in the copies table
            'stock' => 'required|integer|min:0', // foreign data to be stored in the copies table
            'authors' => 'required|array', // foreign data
            'authors.*' => 'exists:authors,id', // Ensure each author ID exists in the authors table
            'categories' => 'required|array', // foreign data
            'categories.*' => 'exists:categories,id', // Ensure each category ID exists in the categories table
        ], [
            'title.required' => 'El título es obligatorio.',
            'cover.required' => 'La portada es obligatoria.',
            'publisher.required' => 'El editor es obligatorio.',
            'synopsis.required' => 'La resumen es obligatorio.',
            'description.required' => 'La descripción es obligatoria.',
            'publication_year.required' => 'El año de publicación es obligatorio.',
            'isbn.required' => 'El ISBN es obligatorio.',
            'stock.required' => 'El stock es obligatorio.',
            'authors.required' => 'Los autores son obligatorios.',
            'categories.required' => 'Las categorías son obligatorias.',
        ]);

        $authors = $data['authors'];
        $categories = $data['categories'];

        unset($data['authors'], $data['categories']);

        // Handle the cover image upload if a file was provided
        if ($request->hasFile('cover')) {
            $data['cover_path'] = $request->file('cover')->store('covers', 'public');
        }

        // we use a transaction to avoid errors when creating the book and attaching the authors and categories
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

    public function search(Request $request): View
    {
        $search = $request->string('search')->toString();
        $categoryIds = collect($request->input('categories', []))
            ->filter(static fn(mixed $id): bool => is_numeric($id))
            ->map(static fn(mixed $id): int => (int) $id)
            ->unique()
            ->values();

        $books = Book::query()
            ->with(['authors', 'categories'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->where('title', 'LIKE', "%{$search}%")
                        ->orWhere('publisher', 'LIKE', "%{$search}%")
                        ->orWhere('synopsis', 'LIKE', "%{$search}%")
                        ->orWhere('isbn', 'LIKE', "%{$search}%");
                });
            })
            ->when($categoryIds->isNotEmpty(), function ($query) use ($categoryIds) {
                $query->whereHas('categories', function ($query) use ($categoryIds) {
                    $query->whereIn('categories.id', $categoryIds);
                });
            })
            ->paginate(12)
            ->withQueryString();

        $categories = Category::query()
            ->orderBy('name', 'asc')
            ->get();

        $library = Library::query()->first();

        return view('book_list', compact('books', 'categories', 'library'));
    }
}
