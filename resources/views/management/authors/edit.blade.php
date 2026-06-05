@extends('layouts.admin')

@section('title', "Editar autor")

@section("content")
    <section class="section">
        <a href="{{ route('authors.index') }}" class="button">Volver a la lista de autores</a>
        <div class="form">
            <h1>Editar autor</h1>
            <form action="{{ route('authors.update', $author->id) }}" method="POST">
                @csrf
                @method('PUT')

                @error('not_found')
                    <p class="error">{{ $message }}</p>
                @enderror

                <label for="name">Nombre del autor</label>
                <input type="text" name="name" maxlength="255" placeholder="Escribe el nombre del autor aquí" required value="{{ old('name', $author->name) }}">

                <label for="biography">Biografía</label>
                <textarea name="biography" placeholder="Escribe la biografía aquí" required>{{ old('biography', $author->biography) }}</textarea>

                <button type="submit">Actualizar autor</button>
            </form>
        </div>
    </section>

@endsection
