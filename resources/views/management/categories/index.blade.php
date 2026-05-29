@extends('layouts.main')

@section('title', 'Categorías')

@section('content')

    <div class="admin">
        <div class="title">
            <h1>Categorías</h1>
        </div>
        <a href="{{ route('categories.create') }}" class="button">Crear nueva categoría</a>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Nombre de categoría</th>
                    <th>Descripción de la categoría</th>
                    <th>Creado el</th>
                    <th>Actualizado el</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->about }}</td>
                        <td>{{ $category->created_at }}</td>
                        <td>{{ $category->updated_at }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="button">Editar</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Category has the following fields: -->
    <!-- 'name', 'about', -->

    <!-- We handle success messages -->

    <!-- First we create the table -->
    <!-- And we iterates for each category and adds a row to a table -->

@endsection
