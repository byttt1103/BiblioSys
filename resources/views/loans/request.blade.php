@extends('layouts.admin')

@section('title', $book->title)

@section('content')
    <section class="section book_info">

        <div class="actions">
            <a href="{{ route('book.info', $book) }}" class="button">
                <span class="text long medium short">Regresar al libro</span>
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
                <h1>Solicitar préstamo: {{ $book->title }}</h1>
                <p>Estás a punto de solicitar el libro <em>{{ $book->title }}</em>, hoy {{ now()->format('d/m/Y') }}.</p>
                <p>Por favor, selecciona la fecha hasta la cual deseas usar el libro. Ten en cuenta que el préstamo mínimo
                    es de 2 días y el máximo de 60 días.</p>

                <form method="POST" action="{{ route('loans.confirm', $book) }}">
                    @csrf
                    <div class="form_group">
                        <label for="date">¿Hasta que dia lo vas a usar?</label>
                        <input type="date" name="date" required min="{{ now()->addDays(2)->format('Y-m-d') }}"
                            max="{{ now()->addDays(60)->format('Y-m-d') }}">

                    </div>

                    <div class="form_group">
                        <label for="quantity">Cantidad:</label>
                        <input type="number" name="quantity" required min="1" max="{{ $book->stock }}"
                            value="1">
                    </div>

                    <div class="form_group">
                        <label for="document_number_confirm">Numero de Documento:</label>
                        <input type="text" id="document_number" name="confirmacion_documento" maxlength="10"
                            pattern="[0-9]{1,10}" placeholder="Sin puntos ni espacios"required>
                    </div>

                    <button type="submit"><span class="text">Solicitar préstamo</span></button>
                </form>
            </div>

        </div>
    </section>
@endsection
