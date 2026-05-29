@extends('layouts.main')

@section('title', 'Préstamos')

@section('content')
    <div class="admin">

        @if(!$loans->isEmpty())
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Usuario</th>
                    <th>Libro</th>
                    <th>Estado</th>
                    <th>Fecha de solicitud</th>
                    <th>Fecha de expiración</th>
                    <th>Fecha de devolución</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($loans as $loan)
                    <tr>
                        <td>{{ $loan->id }}</td>
                        <td>{{ $loan->user->first_name }}</td>
                        <td><a href="{{ route('book.info', $loan->book->id) }}">{{ $loan->book->title }}</a></td>
                        <td>{{ $loan->status }}</td>
                        <td>{{ $loan->loan_date }}</td>
                        <td class="{{ $loan->due_date < now() ? 'due' : 'ontime' }}">{{ $loan->due_date }}</td>
                        <td>{{ $loan->returned_at }}</td>
                        <td>{{ $loan->quantity }}</td>
                        <td>
                            <a href="{{ route('admin.loans.edit', $loan->id) }}"><button>Editar</button></a>

                            <form method="POST" action="{{ route('admin.loans.destroy', $loan->id) }}"
                                style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p>No hay préstamos registrados actualmente.</p>
        @endif
    </div>
@endsection
