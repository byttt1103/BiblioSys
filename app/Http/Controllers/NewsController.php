<?php

namespace App\Http\Controllers;

use  App\Models\News;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Devuelve la vista con el formulario a crear una nueva noticia
    // GET /news/create/   (requiere admin)
    public function index(){
        // vease resources/views/create_new_form.blade.php
        $news = News::all();

        return view("management.news.index", compact('news'));
    }


    public function create(){
        return view("management.news.create");
    }

    public function edit(News $news){
        return view("management.news.edit", compact('news'));
    }

    // Recibe los datos del formulario y crea la noticia
    // POST /news/create  (require admin)
    public function store(Request $request){
        // Obtenemos los datos del form y los validamos
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image_url' => 'nullable|url|max:255',
            'category' => 'nullable|string|max:200',
            'tags' => 'nullable|string|max:100'
        ]);

        // Crea la noticia con los datos creados
        $news = News::create($data);

        // Le mandamos hacia atras con una variable 'success'
        return redirect()->back()
            ->with('success', '¡El post se guardó correctamente!');

    }


    public function update(Request $request, News $news){
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
            'image_url' => 'nullable|url|max:255',
            'category' => 'nullable|string|max:200',
            'tags' => 'nullable|string|max:100'
        ]);

        $news->update($data);

        return redirect()->back()->with('success', '¡El post se actualizó correctamente!');

    }

    public function destroy(News $news){
        $news->delete();

        return redirect()->back()->with('success', '¡El post se eliminó correctamente!');
    }

    public function search(Request $request){
        $query = $request->input('query');

        $news = News::query()
            ->where('title', 'like', "%$query%")
            ->orWhere('description', 'like', "%$query%")
            ->orWhere('category', 'like', "%$query%")
            ->orWhere('tags', 'like', "%$query%")
            ->get();

        return view('news_list', compact('news'));
    }
}
