@extends('layouts.admin')

@section('title', 'Libros archivados')

@section('content')
    <section class="section admin">
        <div class="admin_actions">

            <a href="{{ route('books.index') }}" class="button button-small">
                <span class="text long medium short">Ver libros activos</span>
            </a>
            <a href="{{ route('admin.index') }}" class="button button-small"><span class="text long medium short">Volver a Inicio</span></a>
        </div>

        <div class="searchBar">
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
            <h1>Libros Archivados</h1>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Autor</th>
                    <th>Categoría</th>
                    <th>Editorial</th>
                    <th>Stock</th>
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
                        <td>
                            @foreach ($book->categories as $category)
                                {{ $category->name }}@if (!$loop->last)
                                    ,
                                @endif
                            @endforeach
                        </td>
                        <td>{{ $book->publisher }}</td>
                        <td>{{ $book->stock }}</td>
                        <td>{{ $book->isbn }}</td>
                        <td>{{ $book->synopsis }}</td>
                        <td>
                            <div class="admin_actions">
                                <a href="{{ route('books.edit', $book->id) }}" class="button button-small">Editar</a>
                                @if(Auth::user()->id === 1)
                                <form method="POST" action="{{ route('books.restore', $book->id) }}" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="button button-small" ><span class="text long medium short">Restaurar</span></button>
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
