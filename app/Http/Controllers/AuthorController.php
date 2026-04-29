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
        // return view('authors.index', compact('authors'));
    }

    // Returns a view with a form to create a new author
    public function create(){
    }

    // Returns a view with a form to edit an existing author
    public function edit(Author $author){
    }

    // Handles the form submission to create a new author and saves it to the database
    public function store(Request $request){
        // First we validate the data

        // Then we store it

        // Then we redirect back the user with success
    }

    // Handles the form submission to update an existing author and saves the changes to the database
    public function update(Request $request, Author $author){
        // First we validate the data

        // Then we update it

        // Then we redirect back the user with success
    }

    // Deletes an existing author from the database
    public function destroy(Author $author){
        // First we delete the author

        // Then we redirect back the user with success
    }
}
