@extends('layouts.main')

@section('title', 'Usuarios')

@section('content')
    <div class="admin">
        <a href="{{ route('users.create') }}" class="button">Crear Usuario</a>

        @if (session('success'))
            <div style="color: green;">
                {{ session('success') }}
            </div>
        @endif

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
                            {{ $role->name }}@if (!$loop->last), @endif
                        @endforeach
                    </td>

                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="button">Editar</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="button" onclick="return confirm('¿Estás seguro?')">Eliminar </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>
@endsection
