@extends('layouts.admin')

@section('title', 'Categorías')

@section('content')
    <section class="section admin">
        <div class="admin_actions">
            <a href="{{ route('categories.create') }}" class="button">
                <span class="text long medium short">Crear nueva categoría</span>
            </a>
        </div>

        <div class="searchBar">
            @include('partials.search', [
                'action' => route('categories.index'),
                'placeholder' => 'Busca una categoría',
                'search' => old('search', request('search')),
            ])
        </div>

        <table>
            <h1>Categorías</h1>
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
                            <div class="admin_actions">
                                @if ($category->name !== 'Otros')
                                    <a href="{{ route('categories.edit', $category->id) }}"
                                        class="button button-small">Editar</a>
                                    @if (Auth::user()->id === 1)
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="post"
                                            style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="button button-small button-danger"
                                                onclick="return confirm('Estás seguro? Libros asociados a esta categoría, quedarán con la categoría Otros.')"><span
                                                    class="text">Eliminar</span></button>
                                        </form>
                                    @endif
                                @else
                                    <span class="text">No se puede eliminar</span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

@endsection
