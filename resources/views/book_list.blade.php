@extends('layouts.main')

@section('title', 'Libros')

@section('content')

    <div class="section grid">


        @foreach ($books as $book)

        <div class="elementBox">
            <h2>{{ $book->title}}</h3>
            @foreach ($book->authors as $author)
                <h4>{{ $author->name }}</h4>
            @endforeach
            <h5>
                {{ $book->publication_year }} - {{ $book->publisher }}
            </h5>
            <p>
                {{ $book->synopsis }}
            </p>
            <a class="button book_info" href="{{ route('book.info', ['book_id' => $book->id])}}">
               <p class="text">
                Ver más >
               </p>
            </a>
        </div>

        @endforeach
    </div>

    <div class="paginator">
        {{ $books->links() }}
    </div>
@endsection
