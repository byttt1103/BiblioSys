@extends('layouts.main')


@section('title', $book->title)

@section('content')
    <div class="section book_info">
        tiutlo del libro: {{ $book->title }}
        <br><br>
        objerto libro:
        {{ $book }}
    </div>

@endsection
