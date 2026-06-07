@extends('layouts.admin')

@section('title', 'Crear libro')

@section('content')
    <section class="section admin">
        <div class="admin_actions">
            <a class="button" href="{{ route('books.index') }}"><span class="text">Volver a la lista de libros</span></a>
        </div>

        <div class="form">
            <h1>Agregar libro</h1>
            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @error('not_found')
                    <p class="error">{{ $message }}</p>
                @enderror

                <div class="form_group">
                    <label for="title">Título del libro</label>
                    <input type="text" name="title" maxlength="255" placeholder="Escribe el título del libro aquí"
                        required>
                </div>

                <div class="form_group">
                    <label>Autores</label>

                    <div class="multi_select">
                        @foreach ($authors as $author)
                            <div class="select_item">
                                <input type="checkbox" name="authors[]" value="{{ $author->id }}" class="checkbox"
                                    id="author_{{ $author->id }}">
                                <label for="author_{{ $author->id }}">
                                    {{ $author->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form_group">
                    <label>Categorías</label>

                    <div class="multi_select">
                        @foreach ($categories as $category)
                            <div class="select_item">
                                <input type="checkbox" name="categories[]" value="{{ $category->id }}" class="checkbox"
                                    id="category_{{ $category->id }}">
                                <label for="category_{{ $category->id }}">
                                    {{ $category->name }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="form_group">
                    <label for="synopsis">Sinopsis</label>
                    <textarea name="synopsis" placeholder="Escribe la sinopsis aquí" required></textarea>
                </div>

                <div class="form_group">
                    <label for="publication_year">Año de publicación</label>
                    <input type="number" name="publication_year" maxlength="200"
                        placeholder="Escriba el año de publicación">
                </div>

                <div class="form_group">
                    <label for="publisher">Editorial</label>
                    <input type="text" name="publisher" maxlength="100"
                        placeholder="Escribe la editorial del libro aquí">
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
