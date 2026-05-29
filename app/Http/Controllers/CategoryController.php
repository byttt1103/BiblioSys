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
        return view('management.categories.index', compact('categories'));
        // return view('categories.index', compact('categories'));
    }

    // Returns a view with a form for creating a new category
    public function create(){
        return view('management.categories.create');
    }

    // Returns a view with a form for editing an existing category
    public function edit(Category $category){
        return view('management.categories.edit', compact('category'));
    }

    // Handles the form submission for creating a new category
    public function store(Request $request){
        // First we validate the data

        $data = $request-> validate([
            'name'=>'required|string|max:255|unique:categories,name',
            'about'=>'string',
        ]);

        // Then we store it
        Category::create($data);

        // Then we redirect back the user with success
        return redirect()->route('categories.index')->with('success','¡Categoría creada exitosamente!');


    }

    // Handles the form submission for updating an existing category
    public function update(Request $request, Category $category){
        // First we validate the data
        $data = $request-> validate([
            'name'=>'required|string|max:255|unique:categories,name',
            'description'=>'string',
        ]);

        // Then we update it
        $category->update($data);

        // Then we redirect back the user with success
        return redirect()->route('categories.index')->with('success','¡Categoría actualizada exitosamente!');
    }

    // Handles the deletion of a category
    public function destroy(Category $category){
        // First we delete the author
        $category->books()->detach();
        $category->delete();

        // Then we redirect back the user with success
        return redirect()->route('categories.index')->with('success','Categoría eliminada exitosamente');
    }
}
