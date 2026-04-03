<?php

namespace App\Http\Controllers;

use  App\Models\News;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    // Devuelve la vista con el formulario a crear una nueva noticia
    // GET /news/create/   (requiere admin)
    public function show_news_form(){
        // vease resources/views/create_new_form.blade.php
        return view("create_new_form");
    }

    // Recibe los datos del formulario y crea la noticia
    // POST /news/create  (require admin)
    public function create_news(Request $request){
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
    public function update_news(){
        
    }
}
