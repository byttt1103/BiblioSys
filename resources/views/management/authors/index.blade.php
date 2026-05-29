@extends('layouts.admin')

@section('title', "Autores")

@section("content")

<div class="title">
    <h1>Autores</h1>
</div>

<a href="{{ route('authors.create') }}" class="button">Crear nuevo autor</a>
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Biografía</th>
            <th> </th>
        </tr>
    </thead>
    <tbody>
        @foreach( $authors as $author)
            <tr>
                <td>{{ $author->name }}</td>
                <td>{{ $author->biography }}</td>
                <td>
                    <a href="{{ route('authors.edit', $author->id) }}" class="button">Editar</a>
                    <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button button-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar este autor?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
