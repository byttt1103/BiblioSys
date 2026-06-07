@extends('layouts.admin')

@section('title', 'Índice')

@section('content')
    <section class="section admin">
        <h1>¡Bienvenido al Dashboard!</h1>
        <p>En el dashboard podrás gestionar toda la biblioteca. <br>
            Desde aquí podrás crear, editar y eliminar libros, gestionar los préstamos, y mucho más. <br>
        </p>
        <div class="libraryStats">
        <h2>Estadísticas de la biblioteca: </h2>
            <div class="elementBox">
                <h3>Top Libros prestados</h3>
                <p>Libros prestados: {{ $topBorrowedBooks->sum('loans_count') }}</p>
                <ul>

                    @foreach($topBorrowedBooks as $book)
                        <li>{{ $book->title }} ({{ $book->authors->pluck('name')->implode(', ') }}) | {{ $book->loans->count() }} préstamo(s)</li>
                    @endforeach
                </ul>
            </div>


        </div>

    </section>
@endsection
