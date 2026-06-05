@extends('layouts.admin')

@section('title', 'Editar noticia')

@section('content')
    <section class="section admin">
        <div class="form">
            <h1>Editar noticia</h1>
            <form action="{{ route('news.update', $news->id) }}" method="POST">
                @csrf
                @method('PUT')

                @error('not_found')
                    <p class="error">{{ $message }}</p>
                @enderror

                <label for="title">Título</label>
                <input type="text" name="title" maxlength="255" placeholder="Escribe el título de la noticia aquí"
                    required value="{{ old('title', $news->title) }}">

                <label for="description">Descripción</label>
                <textarea name="description" placeholder="Escribe la descripción aquí" required>{{ old('description', $news->description) }}</textarea>

                <label for="image_url">URL de la imagen</label>
                <input type="url" name="image_url" maxlength="255" placeholder="Escribe la URL de la imagen aquí"
                    value="{{ old('image_url', $news->image_url) }}">

                <label for="category">Categoría</label>
                <input type="text" name="category" maxlength="200" placeholder="Escribe la categoría"
                    value="{{ old('category', $news->category) }}">

                <label for="tags">Etiquetas</label>
                <input type="text" name="tags" maxlength="100" placeholder="Escribe las etiquetas separadas por comas"
                    value="{{ old('tags', $news->tags) }}">

                <button type="submit">Actualizar</button>
            </form>
        </div>
    </section>
@endsection
