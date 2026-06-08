@extends('layouts.admin')

@section('title', 'Editar categoría')

@section('content')
    <section class="section admin">

        <div class="admin_actions">
            <a class="button" href="{{ route('categories.index') }}"> <span class="text">Volver a las categorías</span></a>
        </div>
        <div class="form">
            <h1>Editar categoría</h1>

            <form action="{{ route('categories.update', $category->id) }}" method="post">
                @csrf
                @method('PUT')


                <div class="form_group">
                    <label for="name">Nombre de la categoría</label>
                    <input type="text" name="name" maxlength="255"
                        placeholder="Escribe el nombre de la categoría aquí" required
                        value="{{ old('name', $category->name) }}">

                </div>
                <div class="form_group">
                    <label for="about">Descripción de la categoría</label>
                    <textarea name="about" placeholder="Escribe la descripción de la categoría aquí" required>{{ old('about', $category->about) }}</textarea>
                </div>
                <button type="submit">Actualizar categoría</button>
            </form>
        </div>
    </section>
@endsection
