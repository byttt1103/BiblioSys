@extends('layouts.admin')

@section('title', 'Préstamos')

@section('content')
    <section class="section admin">
        <div class="section__search">
            @include('partials.search', [
                'action' => route('admin.loans'),
                'placeholder' => 'Busca un préstamo',
                'search' => old('search', request('search')),
            ])
        </div>

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
                        <td>{{ $loan->displayStatus }}</td>
                        <td>{{ $loan->loan_date }}</td>
                        <td class="{{ $loan->due_date < now() ? 'due' : 'ontime' }}">{{ $loan->due_date }}</td>
                        <td>{{ $loan->returned_at }}</td>
                        <td>{{ $loan->quantity }}</td>
                        <td>
                            <div class="admin__actions">
                                <a href="{{ route('admin.loans.edit', $loan->id) }}" class="button button-small">Editar</a>
                                @if($loan->status == 'requested' ||  Auth::user()->id === 1)

                                <form method="POST" action="{{ route('admin.loans.destroy', $loan->id) }}"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button button-small button-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                                </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p>No hay préstamos registrados actualmente.</p>
        @endif
    </section>
@endsection
