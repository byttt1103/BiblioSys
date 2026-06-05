@extends('layouts.admin')

@section('title', $book->title)

@section("content")
    <section class="section book_info">
        <div class="book_container">
            <h1>Solicitar préstamo: {{ $book->title }}</h1>
            <p>Estás a punto de solicitar el libro <em>{{$book->title}}</em>, hoy {{ now()->format('d/m/Y') }}.</p>

            <form method="POST" action="{{ route('loans.confirm', $book) }}">
                @csrf

                <label for="fecha">Hasta que dia lo vas usar?</label>
                <input type="date" name="fecha" required
                    min="{{ now()->addDays(2)->format('Y-m-d') }}"
                    max="{{ now()->addDays(60)->format('Y-m-d') }}">
                    <button type="submit">Solicitar</button>
            </form>


        </div>
    </section>
@endsection
