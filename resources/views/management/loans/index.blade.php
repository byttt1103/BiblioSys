@extends('layouts.admin')

@section('title', 'Préstamos')

@section('content')
    <section class="section admin">
        <div class="admin_actions">
            <a href="{{ route('admin.index') }}" class="button button-small"> <div class="text">Volver al inicio</div></a>
        </div>
        <div class="searchBar">
            @include('partials.search', [
                'action' => route('admin.loans'),
                'placeholder' => 'Busca un préstamo',
                'search' => old('search', request('search')),
            ])
        </div>
        <div class="tables">
            @if (!$loans->isEmpty())
                <table>
                    <h1>Préstamos Activos</h1>
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
                            @if (!$loan->is_archived)
                                <tr>
                                    <td>{{ $loan->id }}</td>
                                    <td>{{ $loan->user->first_name }}</td>
                                    <td><a href="{{ route('book.info', $loan->book->id) }}">{{ $loan->book->title }}</a></td>
                                    <td>{{ $loan->displayStatus }}</td>
                                    <td>{{ $loan->created_at_formatted }}</td>
                                    <td class="{{ $loan->due_date < $loan->returned_at ? 'due' : 'ontime' }}">{{ $loan->due_date_formatted }}</td>
                                    <td>{{ $loan->returned_at_formatted }}</td>
                                    <td>{{ $loan->quantity }}</td>
                                    <td>
                                        <div class="admin_actions">
                                            <a href="{{ route('admin.loans.edit', $loan->id) }}"
                                                class="button button-small"><span class="text">Editar</span></a>

                                            @if ($loan->status !== 'requested' && Auth::user()->id === 1)
                                                <form method="POST" action="{{ route('admin.loans.destroy', $loan->id) }}"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="button button-small button-danger"
                                                        onclick="return confirm('¿Estás seguro?')"><span class="text">Archivar</span></button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <table>
                    <h1>Préstamos Archivados</h1>
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
                            @if ($loan->is_archived)
                                <tr>
                                    <td>{{ $loan->id }}</td>
                                    <td>{{ $loan->user->first_name }}</td>
                                    <td><a href="{{ route('book.info', $loan->book->id) }}">{{ $loan->book->title }}</a>
                                    <td>{{ $loan->displayStatus }}</td>
                                    <td>{{ $loan->created_at_formatted }}</td>
                                     <td class="{{ $loan->due_date < $loan->returned_at ? 'due' : 'ontime' }}">{{ $loan->due_date_formatted }}</td>
                                    <td>{{ $loan->returned_at_formatted }}</td>
                                    <td>{{ $loan->quantity }}</td>
                                    <td>
                                        <div class="admin_actions">

                                            @if ($loan->status === 'requested' || Auth::user()->id === 1)
                                                <form method="POST" action="{{ route('admin.loans.restore', $loan->id) }}"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="button button-small"
                                                        ><span class="text">Restaurar</span></button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No hay préstamos registrados actualmente.</p>
            @endif
        </div>
    </section>
@endsection
