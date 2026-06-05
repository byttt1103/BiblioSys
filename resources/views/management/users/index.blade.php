@extends('layouts.admin')

@section('title', 'Usuarios')

@section('content')
    <section class="section admin">
        <div class="admin__actions">
            <a href="{{ route('users.create') }}" class="button">
                <span class="text long medium short">Crear Usuario</span>
            </a>
        </div>

        <div class="section__search">
            @include('partials.search', [
                'action' => route('users.index'),
                'placeholder' => 'Busca un usuario',
                'search' => old('search', request('search')),
            ])
        </div>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Número de Documento</th>
                    <th>Numero de telefono</th>
                    <th>Correo</th>
                    <th>Dirección de residencia</th>
                    <th>Roles</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->document_number}} </td>
                    <td>{{ $user->phone_number  }}</td>
                    <td>{{ $user->email}}</td>
                    <td>{{ $user->address }}</td>

                    <td>
                        @foreach ($user->roles as $role)
                            {{ $role->displayName }}@if (!$loop->last), @endif
                        @endforeach
                    </td>

                    <td>
                        <div class="admin__actions">
                            <a href="{{ route('users.edit', $user->id) }}" class="button button-small">Editar</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button button-small button-danger" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </section>
@endsection
