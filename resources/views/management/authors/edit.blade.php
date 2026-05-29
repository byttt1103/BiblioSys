@extends('layouts.admin')

@section('title', "Editar autor")

@section("content")

<a href="{{ route('authors.index') }}" class="button">Volver a la lista de autores</a>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
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

@endsection

