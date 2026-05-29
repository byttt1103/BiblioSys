@extends('layouts.admin')

@section('title', "Crear categoría")


@section('content')

    <div class="admin">

        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="error">
                    <p>Error: {{ $error }}</p>
                </div>
            @endforeach
        @endif

        <div class="title">
            <h1>Crear Categoría</h1>
        </div>
        <a class="button" href="{{ route('categories.index') }}">Volver a la lista de categorías</a>

        <form action="{{ route('categories.store') }}" method="post">
            @csrf

            <label for="name">Nombre de la categoría</label>
            <input type="text" name="name" maxlength="255" placeholder="Escribe el nombre de la categoría aquí"
                required >

            <label for="about">Descripción de la categoría</label>
            <textarea name="about" placeholder="Escribe la descripción de la categoría aquí" required></textarea>

            <button type="submit">Crear categoría</button>
        </form>

    </div>

@endsection

