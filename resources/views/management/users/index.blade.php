@extends('layouts.admin')

@section('title', 'Usuarios')

@section('content')
    <section class="section admin">
        <div class="admin_actions">
            <a href="{{ route('users.create') }}" class="button button-small">
                <span class="text long medium short">Crear Usuario</span>
            </a>
            <a href="{{ route('admin.index') }}" class="button button-small">
                <span class="text long medium">Volver al inicio</span>
                <span class="text short">Inicio</span>
            </a>
        </div>

        <div class="searchBar">
            @include('partials.search', [
                'action' => route('users.index'),
                'placeholder' => 'Busca un usuario',
                'search' => old('search', request('search')),
            ])
        </div>
        <div class="tables">
            @if (!$users->isEmpty())
                <table>
                    <h1>Usuarios Activos</h1>
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
                            @if (!$user->is_archived)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->document_number }} </td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            {{ $role->displayName }}@if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="admin_actions">
                                            <a href="{{ route('users.edit', $user->id) }}" class="button button-small">Editar</a>
                                            <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="button button-small button-danger"
                                                    onclick="return confirm('¿Estás seguro? El usuario se desactivará, junto con sus préstamos.')"><span class="text long medium short">Desactivar</span></button>
                                        </div>
                                    </td>
                                </tr>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <table>
                    <h1>Usuarios Archivados</h1>
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
                            @if ($user->is_archived)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->document_number }} </td>
                                    <td>{{ $user->phone_number }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>
                                        @foreach ($user->roles as $role)
                                            {{ $role->displayName }}@if (!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        <div class="admin_actions">
                                            <a href="{{ route('users.edit', $user->id) }}" class="button button-small">Editar</a>
                                            <form action="{{ route('users.restore', $user->id) }}" method="POST"
                                                style="display:inline;">
                                                @csrf
                                                @method('PUT')
                                                <button type="submit" class="button button-small"><span class="text long medium short">Activar</span></button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No hay usuarios registrados actualmente.</p>
            @endif
        </div>



    </section>
@endsection
