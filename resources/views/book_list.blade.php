@extends('layouts.main')

@section('title', 'Libros')

@section('content')
    <section class="section">
        <h1>Libros</h1>
        <div class="searchBar">
            @include('partials.search', [
                'action' => route('book.search'),
                'placeholder' => 'Busca...',
                'search' => old('search', request('search')),
                'mode' => 'books',
                'categories' => $categories ?? collect(),
                'selectedCategories' => request('categories', []),
            ])
        </div>

        @if ($books->isEmpty())
            <p>No se encontraron libros.</p>
        @else
            <div class="grid">
                @foreach ($books as $book)
                    <div class="elementBox">
                        <div class="image">
                            @if ($book->cover_path)
                                <img src="{{ asset('storage/' . $book->cover_path) }}" alt="Portada de {{ $book->title }}">
                            @else
                                <p>Sin portada</p>
                            @endif
                        </div>

                        <div class="info">
                            <h2>{{ $book->title }}</h2>
                            @if ($book->authors->count() == 1)
                                <h3>{{ $book->authors[0]->name }}</h3>
                            @else
                                <h3>
                                    @foreach ($book->authors as $author)
                                        {{ $author->name }}@if (!$loop->last)
                                            ,
                                        @endif
                                    @endforeach
                                </h3>
                            @endif
                            <h5>
                                {{ $book->publication_year }} - {{ $book->publisher }}
                            </h5>

                            @if ($book->stock === 0)
                                <p class="desc stock no_stock">
                                    Sin stock disponible.
                                </p>
                            @else
                                <p class="desc stock">
                                    Stock: {{ $book->stock }}
                                </p>
                            @endif
                        </div>
                        <div class="actions">
                            <a class="button book_info" href="{{ route('book.info', ['book_id' => $book->id]) }}">
                                <p class="text long medium">
                                    Ver más <span aria-hidden="true">🠲</span>
                                </p>
                                <p class="text short" aria-hidden="true">Más 🠲</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="paginator">
                {{ $books->links('partials.pagination') }}
            </div>
        @endif
    </section>
@endsection
