@extends('layouts.admin')

@section('title', 'Libros')

@section('content')
    <section class="section admin">
        <div class="admin_actions">
            <a href="{{ route('books.create') }}" class="button button-small">
                <span class="text long medium short">Crear libro</span>
            </a>
            {{-- Es probable que la ruta en tus definiciones de rutas use el nombre en plural: 'books.archived' en lugar de 'book.archived', ya que la ruta 'books.create' de arriba funciona y usa plural. Laravel suele nombrar las rutas de recursos en plural para el recurso principal. --}}
            <a href="{{ route('books.index') }}" class="button button-small">
                <span class="text long medium short">Ver activos</span>
            </a>
            <a href="{{ route('admin.index') }}" class="button button-small"><span class="text long medium short">Volver a Inicio</span></a>
        </div>

        <div class="section_search">
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
                                <form method="POST" action="{{ route('books.destroy', $book->id) }}" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button button-small button-danger" onclick="return confirm('Estás seguro? Archivará los préstamos asociados al libro también.')"><span class="text long medium short">Archivar</span></button>
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
