@extends('layouts.main')


@section('title', $book->title)

@foreach ($book->authors as $author)
    @section('content')
        <section class="section book_info">
            <div class="book_container">
                <h1>{{ $book->title }}</h1>

                <div class="book_data">
                   <h4 class="author_label">Autor:</h4> <h4 class="year_label">Año de publicación:</h4> <h4 class="editorial_label">Editorial:</h4>
                   <p class="author">{{ $author->name }}</p> <p class="year">{{ $book->publication_year }}</p> <p class="editorial">{{ $book->publisher }}</p>
                   <p class="synopsis">{{ $book->synopsis }}</p>
                </div>

                <div>
                    <a href="{{route('loans.request', $book)}}"><button>Prestar</button></a>
                </div>


            </div>
        </section>
    @endsection
@endforeach
