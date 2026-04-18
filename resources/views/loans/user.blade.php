@extends('layouts.main')

@section('title', "Libros")

@section("content")

        <!-- Si la variable success esta definida, la mostramos  -->
    @if(session('success'))
        <div style="color: green;">
            {{ session('success') }}
        </div>
    @endif

    <h2>Libros de {{$user->first_name}}</h2>

    @foreach($loans as $loan)
        <div class="elementBox">
            <h2>{{ $loan->book->title}}</h2>
            <p>Estado: {{ $loan->status }}</p>
            <p>Pedida el: {{ $loan->loan_date }}</p>
            <p>Expira el: {{ $loan->due_date }}</p>
            <p>Pedidos: {{ $loan->quantity }}</p>

            @if (Auth::user()->roles->pluck('name')->contains('admin'))
            <a href="{{ route('admin.loans.edit', $loan) }}"><button>Editar</button></a>
            @endif

            @if (Auth::user()->roles->pluck('name')->contains('admin'))
                <form method="POST" action="{{ route('admin.loans.destroy', $loan->id) }}" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Estás seguro?')">Eliminar</button>
                </form>
            @endif

        </div>
    @endforeach
@endsection
