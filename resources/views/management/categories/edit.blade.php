@extends('layouts.admin')

@section('title', 'Editar categoría')

@section('content')
    <section class="section admin">
        <div class="title">
            <h1>Editar Categoría</h1>
        </div>
        <a class="button" href="{{ route('categories.index') }}">Volver a la lista de categorías</a>

        <form action="{{ route('categories.update', $category->id) }}" method="post">
            @csrf
            @method('PUT')

            @error('not_found')
                <p class="error">{{ $message }}</p>
            @enderror

            <label for="name">Nombre de la categoría</label>
            <input type="text" name="name" maxlength="255" placeholder="Escribe el nombre de la categoría aquí"
                required value="{{ old('name', $category->name) }}">

            <label for="about">Descripción de la categoría</label>
            <textarea name="about" placeholder="Escribe la descripción de la categoría aquí" required>{{ old('about', $category->about) }}</textarea>

            <button type="submit">Actualizar categoría</button>
        </form>
    </section>
@endsection
