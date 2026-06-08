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

                <div class="form_group">
                    <label for="title">Título del libro</label>
                    <input type="text" name="title" maxlength="255" placeholder="Escribe el título del libro aquí"
                        required value="{{ old('title', $book->title) }}">
                </div>

                <div class="form_group">
                    <label>Autores</label>

                    @php
                        $selectedAuthors = old('authors', $book->authors->pluck('id')->toArray());
                    @endphp

                    <div class="multi_select">
                        @foreach ($authors as $author)
                            <div class="select_item">
                                <input type="checkbox" name="authors[]" value="{{ $author->id }}" class="checkbox"
                                    id="author_{{ $author->id }}" @checked(in_array($author->id, $selectedAuthors))>

                                <label for="author_{{ $author->id }}">
                                    {{ $author->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form_group">
                    <label>Categorías</label>

                    @php
                        $selectedCategories = old('categories', $book->categories->pluck('id')->toArray());
                    @endphp

                    <div class="multi_select">
                        @foreach ($categories as $category)
                            <div class="select_item">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="checkbox"
                                    id="category_{{ $category->id }}" @checked(in_array($category->id, $selectedCategories))>

                                <label for="category_{{ $category->id }}">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form_group">
                    <label for="synopsis">Sinopsis</label>
                    <textarea name="synopsis" placeholder="Escribe la sinopsis aquí" required>{{ old('synopsis', $book->synopsis) }}</textarea>
                </div>

                <div class="form_group">
                    <label for="publication_year">Año de publicación</label>
                    <input type="number" name="publication_year" maxlength="200"
                        placeholder="Escriba el año de publicación"
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
                        placeholder="Escribe la cantidad de ejemplares disponibles"
                        value="{{ old('stock', $book->stock) }}">
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
