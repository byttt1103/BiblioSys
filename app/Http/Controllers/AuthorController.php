<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // Returns a viewwith a table with all the authors
    // in the database with edit and deletebuttons
    public function index(Request $request): View
    {
        $search = $request->string('search')->toString();

        $authors = Author::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('biography', 'LIKE', "%{$search}%");
                });
            })
            ->get();

        return view('management.authors.index', compact('authors'));
    }

    // Returns a view with a form to create a new author
    public function create(): View
    {
        return view('management.authors.create');
    }

    // Returns a view with a form to edit an existing author
    public function edit(Author $author): View
    {
        return view('management.authors.edit', compact('author'));
    }

    // Handles the form submission to create a new author and saves it to the database
    public function store(Request $request)
    {
        // First we validate the data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
        ],[
            'name.required' => 'El nombre es obligatorio.',
            'biography.required' => 'La biografía es obligatoria.',
        ]);

        // Then we store it
        Author::create($data);

        // Then we redirect back the user with success
        return redirect()->route('authors.index')->with('success', 'Autor creado exitosamente.');
    }

    // Handles the form submission to update an existing author and saves the changes to the database
    public function update(Request $request, Author $author)
    {
        // First we validate the data
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
        ],[
            'name.required' => 'El nombre es obligatorio.',
            'biography.required' => 'La biografía es obligatoria.',
        ]);

        // Then we update it
        $author->update($data);

        // Then we redirect back the user with success
        return redirect()->route('authors.index')->with('success', 'Autor actualizado exitosamente.');
    }

    // Deletes an existing author from the database
    public function destroy(Author $author)
    {

        $otherAuthor = Author::query()->where('name', 'LIKE', 'Otros Autores')->first();

        // Reassign each book to the other author
        // We detach the author from the books first to avoid any errors
        foreach ($author->books as $book) {
            $book->authors()->syncWithoutDetaching([$otherAuthor->id]);
        }

        // we delete the author
        $author->delete();

        // Then we redirect back the user with success
        return redirect()->route('authors.index')->with('success', 'Autor eliminado exitosamente.');
    }
}
