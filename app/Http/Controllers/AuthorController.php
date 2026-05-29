<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{
    // Returns a viewwith a table with all the authors
    // in the database with edit and deletebuttons
    public function index(){
        $authors = Author::all();
        return view ('management.authors.index', compact('authors'));
    }

    // Returns a view with a form to create a new author
    public function create(){
    }

    // Returns a view with a form to edit an existing author
    public function edit(Author $author){
        return view('management.authors.edit', compact('author'));
    }

    // Handles the form submission to create a new author and saves it to the database
    public function store(Request $request){
        // First we validate the data
         $data = $request->validate([
            'name' => 'required|string|max:255',
            'biography' => 'nullable|string',
        ]);

        // Then we store it
        Author::create($data);

        // Then we redirect back the user with success
        return redirect()->route('authors.index')->with('success', 'Autor creado exitosamente.');
    }

    // Handles the form submission to update an existing author and saves the changes to the database
    public function update(Request $request, Author $author){
        // First we validate the data
            $data = $request->validate([
                'name' => 'required|string|max:255',
                'biography' => 'nullable|string',
            ]);

        // Then we update it
        $author->update($data);

        // Then we redirect back the user with success
        return redirect()->route('authors.index')->with('success', 'Autor actualizado exitosamente.');
    }

    // Deletes an existing author from the database
    public function destroy(Author $author){

        $otherAuthor = Author::query()->where('name', 'LIKE', 'Otros Autores')->first();

        // Reasigna cada libro al autor "Otros Autores"
        foreach ($author->books as $book) {
            $book->authors()->syncWithoutDetaching([$otherAuthor->id]);
        }

        // we delete the author
        $author->delete();

        // Then we redirect back the user with success
        return redirect()->route('authors.index')->with('success', 'Autor eliminado exitosamente.');
    }
}
