@extends('layouts.admin')

@section('title', 'Crear libro')

@section('content')
    <section class="section admin">
        <a class="button" href="{{ route('books.index') }}"><span class="text">Volver a la lista de libros</span></a>

        <div class="form">
            <h1>Agregar libro</h1>
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @error('not_found')
                    <p class="error">{{ $message }}</p>
                @enderror

                <div class="form_group">
                    <label for="title">Título del libro</label>
                    <input type="text" name="title" maxlength="255" placeholder="Escribe el título del libro aquí" required>
                </div>

                <div class="form_group">
                    <label for="author">Autor</label>
                    <select name="authors[]" multiple required>
                        <option value="">Selecciona un autor</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form_group">
                    <label for="category">Categoría</label>
                    <select name="categories[]" multiple required>
                        <option value="">Selecciona una categoría</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form_group">
                    <label for="synopsis">Sinopsis</label>
                    <textarea name="synopsis" placeholder="Escribe la sinopsis aquí" required></textarea>
                </div>

                <div class="form_group">
                    <label for="publication_year">Año de publicación</label>
                    <input type="number" name="publication_year" maxlength="200" placeholder="Escriba el año de publicación">
                </div>

                <div class="form_group">
                    <label for="publisher">Editorial</label>
                    <input type="text" name="publisher" maxlength="100" placeholder="Escribe la editorial del libro aquí">
                </div>

                <div class="form_group">
                    <label for="isbn">ISBN</label>
                    <input type="text" name="isbn" maxlength="100" placeholder="Escribe el ISBN del libro aquí">
                </div>

                <div class="form_group">
                    <label for="stock">Cantidad de ejemplares</label>
                    <input type="number" name="stock" min="0"
                        placeholder="Escribe la cantidad de ejemplares disponibles">
                </div>

                <div class="form_group">
                    <label for="cover">Portada del Libro:</label>
                    <input type="file" name="cover" id="cover" accept="image/*" class="form-control">
                </div>

                <button type="submit"><span class="text">Crear libro</span></button>
            </form>
        </div>
    </section>
@endsection
