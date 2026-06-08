@extends('layouts.main')


@section('title', $book->title)

@foreach ($book->authors as $author)
    @section('content')
        <section class="section book_info">

            <div class="actions">
                <a href="{{ route('book.list') }}" class="button">
                    <span class="text long medium short">Volver a lista de libros</span>
                </a>
            </div>

            <div class="book_container">
                <div class="book_image">
                    @if ($book->cover_path)
                        <img src="{{ asset('storage/' . $book->cover_path) }}" alt="Portada de {{ $book->title }}">
                    @else
                        <p>Sin portada</p>
                    @endif
                </div>
                <div class="book_details">
                    <h1>{{ $book->title }}</h1>

                    <div class="book_data">
                        <h4 class="author_label">Autor:</h4>
                        <h4 class="year_label">Año de publicación:</h4>
                        <h4 class="editorial_label">Editorial:</h4>
                        <p class="author">{{ $author->name }}</p>
                        <p class="year">{{ $book->publication_year }}</p>
                        <p class="editorial">{{ $book->publisher }}</p>
                    </div>
                    <p class="synopsis">{{ $book->synopsis }}</p>

                    @if ($book->stock === 0)
                        <p class="desc stock no_stock">
                            Sin stock disponible.
                        </p>

                        @auth
                            @php
                                $userHasHold = $book->holds()->where('user_id', Auth::id())->exists();
                            @endphp

                            <form method="POST" action="{{ route('books.hold', $book) }}">
                                @csrf
                                @if ($userHasHold)
                                    <button type="submit" class="button secondary">
                                        <span class="text long medium short">Cancelar aviso</span>
                                    </button>
                                @else
                                    <button type="submit" class="button">
                                        <span class="text long medium short">Avisarme cuando esté disponible</span>
                                    </button>
                                @endif
                            </form>
                        @else
                            <p><a href="{{ route('login') }}" class="button">Inicia sesión</a> para recibir un aviso cuando esté disponible.
                            </p>
                        @endauth
                    @else
                        <p class="desc stock">
                            Stock: {{ $book->stock }}
                        </p>
                        <div>
                            <a href="{{ route('loans.request', $book) }}" class="button">
                                <span class="text long medium short">Pedir Prestado</span>
                            </a>
                        </div>
                    @endif
                </div>


            </div>
        </section>
    @endsection
@endforeach
