@extends('layouts.admin')

@section('title', 'Editar libro')

@section('content')
    <section class="section admin">
        <div class="admin_actions">
            <a href="{{ route('books.index') }}" class="button button-small">
                <span class="text long medium short">Volver a la lista de libros</span>
            </a>
        </div>

        <div class="form">
            <h1>Editar libro</h1>
            <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @error('not_found')
                    <p class="error">{{ $message }}</p>
                @enderror
                <div class="form_group">
                    <label for="title">Título del libro</label>
                    <input type="text" name="title" maxlength="255" placeholder="Escribe el título del libro aquí"
                        required value="{{ old('title', $book->title) }}">
                </div>

                <div class="form_group">
                    <label for="authors">Autor</label>
                    <select name="authors[]" multiple required>
                        <option value="">Selecciona un autor</option>
                        @foreach ($authors as $author)
                            <option value="{{ $author->id }}"
                                {{ in_array($author->id, old('authors', $book->authors->pluck('id')->toArray())) ? 'selected' : '' }}>
                                {{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form_group">
                    <label for="category">Categoría</label>
                    <select name="categories[]" multiple required>
                        <option value="">Selecciona una categoría</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ in_array($category->id, old('categories', $book->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form_group">
                    <label for="synopsis">Sinopsis</label>
                    <textarea name="synopsis" placeholder="Escribe la sinopsis aquí" required>{{ old('synopsis', $book->synopsis) }}</textarea>
                </div>

                <div class="form_group">
                <label for="publication_year">Año de publicación</label>
                <input type="number" name="publication_year" maxlength="200" placeholder="Escriba el año de publicación"
                    value="{{ old('publication_year', $book->publication_year) }}">
                </div>

                <div class="form_group">
                <label for="publisher">Editorial</label>
                <input type="text" name="publisher" maxlength="100" placeholder="Escribe la editorial del libro aquí"
                    value="{{ old('publisher', $book->publisher) }}">
                </div>

                <div class="form_group">
                    <label for="isbn">ISBN</label>
                    <input type="text" name="isbn" maxlength="100" placeholder="Escribe el ISBN del libro aquí"
                        value="{{ old('isbn', $book->isbn) }}">
                </div>

                <div class="form_group">
                    <label for="stock">Cantidad de ejemplares</label>
                    <input type="number" name="stock" min="0"
                        placeholder="Escribe la cantidad de ejemplares disponibles" value="{{ old('stock', $book->stock) }}">
                </div>

                <div class="form_group">
                    <label for="cover">Portada del Libro:</label>
                    <input type="file" name="cover" id="cover" accept="image/*" class="form-control">
                </div>

                <button type="submit">Actualizar</button>
            </form>
        </div>
    </section>
@endsection
