<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Returns a view with a table with all the categories,
    // along with edit and delete buttons
    public function index(Request $request): View
    {
        $search = $request->string('search')->toString();

        $categories = Category::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('about', 'LIKE', "%{$search}%");
                });
            })
            ->get();

        return view('management.categories.index', compact('categories'));
        // return view('categories.index', compact('categories'));
    }

    // Returns a view with a form for creating a new category
    public function create()
    {
        return view('management.categories.create');
    }

    // Returns a view with a form for editing an existing category
    public function edit(Category $category)
    {
        return view('management.categories.edit', compact('category'));
    }

    // Handles the form submission for creating a new category
    public function store(Request $request)
    {
        // First we validate the data

        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'about' => 'string',
        ],[
            'name.required' => 'El nombre es obligatorio.',
            'about.required' => 'La descripción es obligatoria.',
        ]);

        // Then we store it
        Category::create($data);

        // Then we redirect back the user with success
        return redirect()->route('categories.index')->with('success', '¡Categoría creada exitosamente!');

    }

    // Handles the form submission for updating an existing category
    public function update(Request $request, Category $category)
    {
        // First we validate the data
        $data = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'string',
        ]);

        // Then we update it
        $category->update($data);

        // Then we redirect back the user with success
        return redirect()->route('categories.index')->with('success', '¡Categoría actualizada exitosamente!');
    }

    // Handles the deletion of a category
    public function destroy(Book $book,Category $category)
    {

        $otherCategory = Category::query()->where('name', 'LIKE', 'Otros')->firstOrNew();

        // We move the books to the other category
        foreach ($category->books as $book) {
            $book->categories()->syncWithoutDetaching([$otherCategory->id]);
        }

        // We delete the category
        $category->delete();

        // Then we redirect back the user with success
        return redirect()->route('categories.index')->with('success', 'Categoría eliminada exitosamente');
    }
}
