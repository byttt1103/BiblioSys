@extends('layouts.main')

@section('title', 'Crear libro')

@section('content')

    <!-- Si la variable success esta definida, la mostramos  -->
    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div style="color: red;">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="form">
        <h1>Agregar libro</h1>
        <form action="{{ route('books.store') }}" method="POST">
            @csrf

            @error('not_found')
                <p class="error">{{ $message }}</p>
            @enderror

            <label for="title">Título del libro</label>
            <input
                type="text"
                name="title"
                maxlength="255"
                placeholder="Escribe el título del libro aquí"
                required
            >

            <label for="author">Autor</label>
            <select name="authors[]" multiple required>
                <option value="">Selecciona un autor</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>

            <label for="category">Categoría</label>
            <select name="categories[]" multiple required>
                <option value="">Selecciona una categoría</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <label for="synopsis">Sinopsis</label>
            <textarea
                name="synopsis"
                placeholder="Escribe la sinopsis aquí"
                required>
            </textarea>

            <label for="publication_year">Año de publicación</label>
            <input
                type="number"
                name="publication_year"
                maxlength="200"
                placeholder="Escriba el año de publicación"
            >

            <label for="publisher">Editorial</label>
            <input
                type="text"
                name="publisher"
                maxlength="100"
                placeholder="Escribe la editorial del libro aquí"
            >

            <label for="isbn">ISBN</label>
            <input
                type="text"
                name="isbn"
                maxlength="100"
                placeholder="Escribe el ISBN del libro aquí"
            >

            <label for="stock">Cantidad de ejemplares</label>
            <input
                type="number"
                name="stock"
                min="0"
                placeholder="Escribe la cantidad de ejemplares disponibles"
            >

            <label for="cover_path">Ruta de la portada</label>
            <input
                type="text"
                name="cover_path"
                maxlength="100"
                placeholder="Escribe la ruta de la portada del libro aquí"
            >

            <button type="submit">Enviar</button>
        </form>
    </div>
@endsection
