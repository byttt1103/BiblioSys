{{-- this is the book_list view, based on the main layout, and builded
with some partials, like the paginator --}}

@extends('layouts.main')

@section('title', 'Libros')

@section('content')

    <h1>Libros</h1>

    <form action="{{ route('book.search') }}" method="GET">
        <input type="text" name="search" placeholder="Busca..." value="{{ old('search', request('search')) }}"/>
        <button type="submit">Buscar</button>
    </form>

    @if($books->isEmpty())
        <p>No se encontraron libros.</p>
    @else
    <div class="grid">

        @foreach ($books as $book)

        <div class="elementBox">
            <h2>{{ $book->title}}</h2>
                @if ($book->authors->count() == 1)
                    <h3>{{ $book->authors[0]->name }}</h3>
                @else
                    <h3>
                        @foreach ($book->authors as $author)
                            {{ $author->name }}@if (!$loop->last), @endif
                        @endforeach
                    </h3>

                @endif
            <h5>
                {{ $book->publication_year }} - {{ $book->publisher }}
            </h5>
            <p class="desc">
                {{ $book->synopsis }}
            </p>
            <a class="button book_info" href="{{ route('book.info', ['book_id' => $book->id])}}">
               <p class="text long medium">
                Ver más <span aria-hidden="true">🠲</span>
               </p>
               <p class="text short" aria-hidden="true">Más 🠲</p>
            </a>
        </div>

        @endforeach
    </div>

    <div class="paginator">
        {{ $books->links('partials.pagination') }}
    </div>
    @endif
@endsection
