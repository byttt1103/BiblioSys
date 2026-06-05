@extends('layouts.admin')

@section('title', 'Crear Usuario')

@section('content')
    <section class="section admin">
        <h1>Crear Usuario</h1>

        <form method="POST" action="{{ route('users.store') }}">
            @csrf
            <div>
                <label for="first_name">Nombre:</label>
                <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
            </div>
            <div>
                <label for="last_name">Apellido:</label>
                <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
            </div>
            <div>
                <label for="document_number">Numero de Documento:</label>
                <input type="text" id="document_number" name="document_number" value="{{ old('document_number') }}"
                    maxlength="12" pattern="[0-9]{1,10}" placeholder="Sin puntos ni espacios"required>
            </div>
            <div>
                <label for="phone_number">Número de teléfono:</label>
                <input type="text" id="phone_number_show" placeholder="+57 3XX XXX XXXX">
                <input type="hidden" name="phone_number" id="phone_number">
            </div>
            <div>
                <label for="address">Dirección de residencia:</label>
                <input type="text" id="address" name="address" value="{{ old('address') }}" required>
            </div>
            <div>
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            </div>

            @if (Auth::user()->roles->pluck('id')->contains(1))
                <div>
                    <label for="roles">Roles:</label>
                    <select id="roles" name="roles[]" required>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}"
                                {{ collect(old('roles'))->contains($role->id) ? 'selected' : '' }}>
                                {{ $role->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            @endif
            <div>
                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
            <button type="submit" class="button">Crear Usuario</button>
        </form>
    </section>
@endsection
