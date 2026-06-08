@extends('layouts.admin')

@section('title', 'Inicio')

@section('content')
    <section class="section admin adminStats">
        <h1>¡Bienvenido a BiblioAdmin!</h1>
        <p>
            Desde aquí podrás gestionar libros, préstamos, usuarios, configuración, y mucho más. <br>
        </p>
        <h2>Estadísticas de la biblioteca: </h2>
        <div class="libraryStats">

            <div class="badges">
                <div class="badge-item">
                    <p>Usuarios: {{ $users }}</p>
                </div>
                <div class="badge-item">
                    <p>Libros: {{ $books }}</p>
                </div>
                <div class="badge-item">
                    <p>Libros prestados: {{ $topBorrowedBooks->sum('loans_count') }}</p>
                </div>
                <div class="badge-item {{ $overdueLoans > 0 ? "bad" : "good" }}">
                    <p>Préstamos vencidos: {{ $overdueLoans > 0 ? $overdueLoans : 'Todos están al día' }}</p>
                </div>
            </div>
            <div class="quickCards">
                <div class="elementBox">
                    <h2>Top Libros prestados</h2>
                    <div class="info">
                        <ul>
                            @foreach ($topBorrowedBooks as $book)
                                <li>
                                    <h2 class="rank">{{ $loop->iteration }}</h2>
                                    <div class="bookInfo">
                                        <span class="title">{{ $book->title }}</span>
                                        <span class="author">{{ $book->authors->pluck('name')->implode(', ') }}</span>
                                    </div>
                                    <span class="loanCount">{{ $book->loans->count() }} préstamo(s)</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="elementBox">
                    <h2>Préstamos recientes</h2>
                    <div class="info">
                        <ul>
                            @foreach ($recentLoans as $loan)
                                <li>
                                    <h2 class="rank">{{ $loop->iteration }}</h2>
                                    <div class="bookInfo">
                                        <span class="title">{{ $loan->book->title }}</span>
                                        <span
                                            class="author">{{ $loan->book->authors->pluck('name')->implode(', ') }}</span>
                                    </div>
                                    <span class="loanCount">{{ $loan->created_at_formatted }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="elementBox">
                    <h2>Lectores Estrella</h2>
                    <div class="info">

                        <ul>
                            @foreach ($topUsers as $user)
                                <li>
                                    <h2 class="rank">{{ $loop->iteration }}</h2>
                                    <div class="bookInfo">
                                        <span class="title">{{ $user->first_name }} {{ $user->last_name }}</span>
                                        <span class="author">{{ $user->email }}</span>
                                    </div>
                                    <span class="loanCount">{{ $user->loans->count() }} préstamo(s)</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="elementBox">
                    <h2>Libros en riesgo</h2>
                    <div class="info">
                        <ul>
                            @foreach ($lowStockBooks as $book)
                                <li>
                                    <h2 class="rank">{{ $loop->iteration }}</h2>
                                    <div class="bookInfo">
                                        <span class="title">{{ $book->title }}</span>
                                        <span class="author">{{ $book->authors->pluck('name')->implode(', ') }}</span>
                                    </div>
                                    <span class="loanCount">{{ $book->stock }} Ejemplar(es)</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>



        </div>

    </section>
@endsection
