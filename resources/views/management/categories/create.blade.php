@extends('layouts.admin')

@section('title', "Crear categoría")


@section('content')
    <section class="section admin">

        <div class="admin_actions">
            <a class="button" href="{{ route('categories.index') }}"><span class="text">Volver a las categorías</span></a>
        </div>
        <div class="form">
            <h1>Crear Categoría</h1>
        <form action="{{ route('categories.store') }}" method="post">
            @csrf
            <div class="form_group">
            <label for="name">Nombre de la categoría</label>
            <input type="text" name="name" maxlength="255" placeholder="Escribe el nombre de la categoría aquí"
                required>
            </div>
            <div class="form_group">
            <label for="about">Descripción de la categoría</label>
            <textarea name="about" placeholder="Escribe la descripción de la categoría aquí" required></textarea>
            </div>

            <button type="submit">Crear categoría</button>
        </form>
        </div>
    </section>

@endsection
