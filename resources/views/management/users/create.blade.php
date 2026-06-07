@extends('layouts.admin')

@section('title', 'Crear Usuario')

@section('content')
    <section class="section admin">

        <div class="admin_actions">
            <a href="{{ route('users.index') }}" class="button button-small">
                <span class="text long medium short">Volver a la lista de usuarios</span>
            </a>
        </div>

        <div class="form">
            <form method="POST" action="{{ route('users.store') }}">
                <h1>Crear Usuario</h1>
                @csrf
                <div class="form_group">
                    <label for="first_name">Nombre:</label>
                    <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                    @error('first_name')
                        <p class="error">El nombre es obligatorio y no puede exceder los 255 caracteres</p>
                    @enderror
                    </div>
                    <div class="form_group">
                        <label for="last_name">Apellido:</label>
                        <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                        @error('last_name')
                            <p class="error">El apellido es obligatorio y no puede exceder los 255 caracteres</p>
                        @enderror
                        </div>
                        <div class="form_group">
                            <label for="document_number">Numero de Documento:</label>
                            <input type="text" id="document_number" name="document_number" value="{{ old('document_number') }}"
                                maxlength="10" pattern="[0-9]{1,10}" placeholder="Sin puntos ni espacios" required>
                            @error('document_number')
                                <p class="error">El número de documento es obligatorio, debe ser único y tener entre 6 y 12 caracteres
                                </p>
                            @enderror
                        </div>
                        <div class="form_group">
                            <label for="phone_number">Número de teléfono:</label>
                            <input type="text" id="phone_number_show" placeholder="+57 3XX XXX XXXX">
                            <input type="hidden" name="phone_number" id="phone_number">
                            @error('phone_number')
                                <p class="error">El número de teléfono es obligatorio, debe ser válido y tener 10 dígitos</p>
                            @enderror
                        </div>
                        <div class="form_group">
                            <label for="address">Dirección de residencia:</label>
                            <input type="text" id="address" name="address" value="{{ old('address') }}" required>
                            @error('address')
                                <p class="error">El dirección de residencia es obligatoria y no puede exceder los 255 caracteres</p>
                            @enderror
                        </div>
                        <div class="form_group">
                            <label for="email">Correo Electrónico:</label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email')
                                <p class="error">El correo electrónico es obligatorio, debe ser válido y no puede exceder los 255
                                    caracteres</p>
                            @enderror
                        </div>

                        @if (Auth::user()->roles->pluck('id')->contains(1))
                            <div class="form_group">
                                <label for="roles">Roles:</label>
                                <select id="roles" name="roles" required>
                                    <option value="" disabled selected>Selecciona un rol</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ collect(old('roles'))->contains($role->id) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <p class="error">El campo rol es obligatorio</p>
                                @enderror

                            </div>
                        @endif
                        <div class="form_group">
                            <label for="password">Contraseña:</label>
                            <div class="password_input">
                                <input type="password" class="password" name="password" id="password" required>
                                <button type="button" id="togglePassword"><span class="icon">🙈 </span></button>
                            </div>
                            @error('password')
                                <p class="error">La contraseña es obligatoria y debe tener al menos 8 caracteres</p>
                            @enderror
                        </div>
                        <div class="form_group">
                            <label for="password_confirmation">Confirmar Contraseña:</label>
                            <div class="password_input">
                                <input type="password" class="password" name="password_confirmation" id="password_confirmation"
                                    required>
                            </div>
                            @error('password_confirmation')
                                <p class="error">Las contraseñas no coinciden</p>
                            @enderror
                        </div>
                        <button type="submit" class="button">Crear Usuario</button>
                    </form>
                </div>
            </section>
        @endsection
