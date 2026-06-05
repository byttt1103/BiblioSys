@extends('layouts.admin')

@section('title', 'Libros')

@section('content')
    <section class="section admin">
        <div class="admin__actions">
            <a href="{{ route('books.create') }}" class="button">
                <span class="text long medium short">Crear libro</span>
            </a>
        </div>

        <div class="section__search">
            @include('partials.search', [
                'action' => route('books.index'),
                'placeholder' => 'Busca un libro',
                'search' => old('search', request('search')),
                'mode' => 'books',
                'categories' => $categories ?? collect(),
                'selectedCategories' => request('categories', []),
            ])
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Editorial</th>
                    <th>ISBN</th>
                    <th>Sinopsis</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                    <tr>
                        <td>{{ $book->id }}</td>
                        <td>{{ $book->title }}</td>
                        <td>
                            @foreach ($book->authors as $author)
                                {{ $author->name }}@if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $book->publisher }}</td>
                        <td>{{ $book->isbn }}</td>
                        <td>{{ $book->synopsis }}</td>
                        <td>
                            <div class="admin__actions">
                                <a href="{{ route('books.edit', $book->id) }}" class="button button-small">Editar</a>
                                @if(Auth::user()->id === 1)
                                <form method="POST" action="{{ route('books.destroy', $book->id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button button-small button-danger" onclick="return confirm('Estás seguro?')">Eliminar</button>
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
