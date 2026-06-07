@extends('layouts.admin')

@section('title', 'Editar Usuario')

@section('content')
    <section class="section admin">
        <div class="admin_actions">
            <a href="{{ route('users.index') }}" class="button button-small">
                <span class="text long medium short">Volver a la lista de usuarios</span>
            </a>
        </div>
        <div class="form">
            <h1>Editar Usuario</h1>

            <form method="POST" action="{{ route('users.update', $user->id) }}">
                @csrf
                @method('PUT')

                <div class="form_group">
                    <label for="first_name">Nombre:</label>
                    <input type="text" id="first_name" name="first_name"
                        value="{{ old('first_name', $user->first_name) }}" required>
                    @error('first_name')
                        <p class="error">El nombre es obligatorio y no puede exceder los 255 caracteres</p>
                    @enderror
                </div>
                <div class="form_group">
                    <label for="last_name">Apellido:</label>
                    <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                        required>
                    @error('last_name')
                        <p class="error">El apellido es obligatorio y no puede exceder los 255 caracteres</p>
                    @enderror
                </div>
                <div class="form_group">
                    <label for="document_number">Numero de Documento:</label>
                    <input type="text" id="document_number" name="document_number"
                        value="{{ old('document_number', $user->document_number) }}" maxlength="12"
                        placeholder="Sin puntos ni espacios" required>
                    @error('document_number')
                        <p class="error">El número de documento es obligatorio, debe ser único y tener entre 6 y 12 caracteres
                        </p>
                    @enderror
                </div>
                <div class="form_group">
                    <label for="phone_number">Número de teléfono:</label>
                    <input type="text" id="phone_number_show" placeholder="+57 3XX XXX XXXX"
                        value="{{ old('phone_number', $user->phone_number) }}">
                    <input type="hidden" name="phone_number" id="phone_number">
                    @error('phone_number')
                        <p class="error">El número de teléfono es obligatorio y debe tener un formato válido de teléfono
                            colombiano (10 dígitos)</p>
                    @enderror
                </div>
                <div class="form_group">
                    <label for="address">Dirección de residencia:</label>
                    <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}"
                        required>
                    @error('address')
                        <p class="error">La dirección de residencia es obligatoria</p>
                    @enderror
                </div>
                <div class="form_group">
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <p class="error">El correo electrónico es obligatorio, debe ser válido y único en el sistema</p>
                    @enderror
                </div>
                @if (Auth::user()->roles->pluck('id')->contains(1))
                    <div class="form_group">
                        <label for="roles">Roles:</label>
                        <select id="roles" name="roles[]" required>
                            @php
                                $roles = collect(old('roles', $user->roles->pluck('id')));
                            @endphp
                            <option value="3" {{ $roles->contains(3) ? 'selected' : '' }}>Lector</option>
                            <option value="2" {{ $roles->contains(2) && !$roles->contains(3) ? 'selected' : '' }}>
                                Librero
                            </option>
                            <option value="1" {{ $roles->contains(1) ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('roles')
                            <p class="error">Debes seleccionar al menos un rol válido para el usuario</p>
                        @enderror
                    </div>
                @elseif(Auth::user()->roles->pluck('id')->contains(2))
                    <input type="hidden" name="roles" value="3">
                @endif
                <div class="form_group">
                    <label for="password">Contraseña:</label>
                    <div class="password_input">
                        <input type="password" class="password" name="password">
                        <button type="button" id="togglePassword"><span class="icon">🙈 </span></button>
                    </div>
                    @error('password')
                        <p class="error">La contraseña debe tener al menos 8 caracteres y confirmarse correctamente si decides
                            modificarla</p>
                    @enderror
                </div>
                <div class="form_group">
                    <label for="password_confirmation">Confirmar Contraseña:</label>
                    <div class="password_input">
                        <input type="password" class="password" name="password_confirmation" id="password_confirmation">
                    </div>
                    @error('password_confirmation')
                        <p class="error">La confirmación de contraseña debe coincidir con la nueva contraseña</p>
                    @enderror
                </div>
                <button type="submit" class="button">Editar Usuario</button>
            </form>
        </div>
    </section>
@endsection
