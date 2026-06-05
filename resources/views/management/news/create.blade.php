@extends('layouts.admin')

@section('title', 'Crear noticia')

@section('content')
    <section class="section admin">
        <div class="form">
            <h1>Crear noticia</h1>
            <form action="{{ route('news.store') }}" method="POST">
                @csrf

                @error('not_found')
                    <p class="error">{{ $message }}</p>
                @enderror

                <label for="title">Título de la noticia</label>
                <input type="text" name="title" maxlength="255" placeholder="Escribe el título de aquí" required>

                <label for="description">Descripción</label>
                <textarea name="description" placeholder="Escribe la descripción aquí" required>
            </textarea>

                <label for="image_url">URL de Imagen</label>
                <input type="url" name="image_url" maxlength="255" placeholder="https://ejemplo.com/imagen.jpg">

                <label for="category">Categoría</label>
                <input type="text" name="category" maxlength="200" placeholder="Escribe la categoría">

                <label for="tags">Etiquetas (separadas por comas)</label>
                <input type="text" name="tags" maxlength="100" placeholder="tag1, tag2, tag3">

                <button type="submit">Enviar</button>
            </form>
        </div>
    </section>
@endsection
