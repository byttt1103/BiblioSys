@extends('layouts.main')

@section('title', 'Libros')

@section('content')


    <div class="admin">
        @if (session('success'))
            <div style="color: green;">
                {{ session('success') }}
            </div>
        @endif

    <a href=" {{ route('books.create') }} "><button>Crear libro</button></a>

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
                            <a href="{{ route('books.edit', $book->id) }}"><button>Editar</button></a>
                            <form method="POST" action="{{ route('books.destroy', $book->id) }}" style="display:inline;">
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
@endsection
