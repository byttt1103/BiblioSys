@extends('layouts.admin')

@section('title', 'Editar Usuario')

@section('content')
    <section class="section admin">
        <h1>Editar Usuario</h1>

        <form method="POST" action="{{ route('users.update', $user->id) }}">
            @csrf
            @method('PUT')

            <div>
                <label for="first_name">Nombre:</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}" required>
            </div>
            <div>
                <label for="last_name">Apellido:</label>
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}" required>
            </div>
            <div>
                <label for="document_number">Numero de Documento:</label>
                <input type="text" id="document_number" name="document_number" value="{{ old('document_number', $user->document_number) }}"
                    maxlength="12" placeholder="Sin puntos ni espacios" required>
            </div>
            <div>
                <label for="phone_number">Número de teléfono:</label>
                <input type="text" id="phone_number_show" placeholder="+57 3XX XXX XXXX" value="{{ old('phone_number', $user->phone_number) }}">
                <input type="hidden" name="phone_number" id="phone_number">
            </div>
            <div>
                <label for="address">Dirección de residencia:</label>
                <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}" required>
            </div>
            <div>
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>
            @if (Auth::user()->roles->pluck('id')->contains(1))
                <div>
                    <label for="roles">Roles:</label>
                    <select id="roles" name="roles[]" required>
                        @php
                            $roles = collect(old('roles', $user->roles->pluck('id')));
                        @endphp
                        <option value="3" {{ $roles->contains(3) ? 'selected' : '' }}>Lector</option>
                        <option value="2" {{ $roles->contains(2) && !$roles->contains(3) ? 'selected' : '' }}>Librero</option>
                        <option value="1" {{ $roles->contains(1) ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
            @elseif(Auth::user()->roles->pluck('id')->contains(2))
                <input type="hidden" name="roles" value="3">
            @endif
            <div>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password">
            </div>
            <div>
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation">
            </div>

            <button type="submit" class="button">Editar Usuario</button>
        </form>
    </section>
@endsection
