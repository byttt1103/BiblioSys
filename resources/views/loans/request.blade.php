@extends('layouts.main')

@section('title', $book->title)

@section("content")
    <div class="section book_info">
        <div class="book_container">
            <h1>{{ $book->title }}</h1>
            <p>Seguro que quieres pedir prestado <b>{{$book->title}}</b>?</p>

            <form method="POST" action="{{ route('loans.confirm', $book) }}">
                @csrf

                <label for="fecha">Hasta que dia lo vas usar?</label>
                <input type="date" name="fecha" required
                    min="{{ now()->addDays(2)->format('Y-m-d') }}"
                    max="{{ now()->addDays(60)->format('Y-m-d') }}">
                    <button type="submit">Solicitar</button>
            </form>


        </div>
    </div>
@endsection

