<?php

namespace App\Http\Controllers;

use  App\Models\Category;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Returns a view with a table with all the categories,
    // along with edit and delete buttons
    public function index(){
        $categories = Category::all();
        // return view('categories.index', compact('categories'));
    }

    // Returns a view with a form for creating a new category
    public function create(){
    }

    // Returns a view with a form for editing an existing category
    public function edit(Category $category){
    }

    // Handles the form submission for creating a new category
    public function store(Request $request){
        // First we validate the data

        // Then we store it

        // Then we redirect back the user with success
    }

    // Handles the form submission for updating an existing category
    public function update(Request $request, Category $category){
        // First we validate the data

        // Then we update it

        // Then we redirect back the user with success
    }

    // Handles the deletion of a category
    public function destroy(Category $category){
        // First we delete the author

        // Then we redirect back the user with success
    }
}
