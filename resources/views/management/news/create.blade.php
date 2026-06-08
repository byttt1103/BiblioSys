@extends('layouts.admin')

@section('title', 'Crear noticia')

@section('content')
    <section class="section admin">

        <div class="admin_actions">
            <a href="{{ route('news.index') }}" class="button button-small">
                <span class="text long medium short">Volver a la lista de noticias</span>
            </a>
        </div>

        <div class="form">
            <h1>Crear noticia</h1>
            <form action="{{ route('news.store') }}" method="POST">
                @csrf

                <div class="form_group">
                    <label for="title">Título de la noticia</label>
                    <input type="text" name="title" maxlength="255" placeholder="Escribe el título de aquí" required>
                </div>

                <div class="form_group">
                    <label for="description">Descripción</label>
                    <textarea name="description" placeholder="Escribe la descripción aquí" required>
            </textarea>
                </div>

                <div class="form_group">
                    <label for="image_url">URL de Imagen</label>
                    <input type="url" name="image_url" maxlength="255" placeholder="https://ejemplo.com/imagen.jpg">
                </div>

                <div class="form_group">
                    <label for="category">Categoría</label>
                    <input type="text" name="category" maxlength="200" placeholder="Escribe la categoría">
                </div>

                <div class="form_group">
                    <label for="tags">Etiquetas (separadas por comas)</label>
                    <input type="text" name="tags" maxlength="100" placeholder="tag1, tag2, tag3">
                </div>

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
