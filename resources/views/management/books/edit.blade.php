@extends('layouts.admin')

@section('title', 'Editar libro')

@section('content')
    <section class="section admin">
        <a class="button" href="{{ route('books.index') }}">Volver a la lista de libros</a>

        <div class="form">
            <h1>Editar libro</h1>
            <form action="{{ route('books.update', $book->id) }}" method="POST">
                @csrf
                @method('PUT')

                @error('not_found')
                    <p class="error">{{ $message }}</p>
                @enderror

                <label for="title">Título del libro</label>
                <input type="text" name="title" maxlength="255" placeholder="Escribe el título del libro aquí" required
                    value="{{ old('title', $book->title) }}">

                <label for="authors">Autor</label>
                <select name="authors[]" multiple required>
                    <option value="">Selecciona un autor</option>
                    @foreach ($authors as $author)
                        <option value="{{ $author->id }}">{{ $author->name }}</option>
                    @endforeach
                </select>

                <label for="category">Categoría</label>
                <select name="categories[]" multiple required>
                    <option value="">Selecciona una categoría</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ in_array($category->id, old('categories', $book->categories->pluck('id')->toArray())) ? 'selected' : '' }}>
                            {{ $category->name }}</option>
                    @endforeach
                </select>

                <label for="synopsis">Sinopsis</label>
                <textarea name="synopsis" placeholder="Escribe la sinopsis aquí" required
                    value="{{ old('synopsis', $book->synopsis) }}">
            </textarea>

                <label for="publication_year">Año de publicación</label>
                <input type="number" name="publication_year" maxlength="200" placeholder="Escriba el año de publicación"
                    value="{{ old('publication_year', $book->publication_year) }}">

                <label for="publisher">Editorial</label>
                <input type="text" name="publisher" maxlength="100" placeholder="Escribe la editorial del libro aquí"
                    value="{{ old('publisher', $book->publisher) }}">

                <label for="isbn">ISBN</label>
                <input type="text" name="isbn" maxlength="100" placeholder="Escribe el ISBN del libro aquí"
                    value="{{ old('isbn', $book->isbn) }}">

                <label for="stock">Cantidad de ejemplares</label>
                <input type="number" name="stock" min="0"
                    placeholder="Escribe la cantidad de ejemplares disponibles" value="{{ old('stock', $book->stock) }}">

                <label for="cover_path">Ruta de la portada</label>
                <input type="text" name="cover_path" maxlength="100"
                    placeholder="Escribe la ruta de la portada del libro aquí"
                    value="{{ old('cover_path', $book->cover_path) }}">

                <button type="submit">Actualizar</button>
            </form>
        </div>
    </section>
@endsection
