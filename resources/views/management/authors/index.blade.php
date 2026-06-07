@extends('layouts.admin')

@section('title', 'Autores')

@section('content')
    <section class="section admin">
        <div class="admin_actions">
            <a href="{{ route('authors.create') }}" class="button">
                <span class="text long medium short">Crear nuevo autor</span>
            </a>
        </div>

        <div class="section_search">
            @include('partials.search', [
                'action' => route('authors.index'),
                'placeholder' => 'Busca un autor',
                'search' => old('search', request('search')),
            ])
        </div>

        <table>
            <h1>Autores</h1>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Biografía</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($authors as $author)
                    <tr>
                        <td>{{ $author->name }}</td>
                        <td>{{ $author->biography }}</td>
                        <td>
                            <div class="admin_actions">
                                <a href="{{ route('authors.edit', $author->id) }}" class="button button-small">Editar</a>
                                @if (Auth::user()->id === 1)
                                    <form action="{{ route('authors.destroy', $author->id) }}" method="POST"
                                        style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button button-small button-danger"
                                            onclick="return confirm('¿Estás seguro de que deseas eliminar este autor?')">Eliminar</button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

@endsection
