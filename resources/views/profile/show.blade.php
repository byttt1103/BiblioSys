@extends('layouts.main')

@section('title', 'Perfil')

@section('content')
    <section class="section">
        <div class="form">
            <h3>Tu perfil</h3>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')


                <div class="form_group">
                    @error('first_name')
                        <p class="error">Nombre invalido</p>
                    @enderror
                    <label for="first_name">Nombre:</label>
                    <input value="{{ $user->first_name }}" type="text" name="first_name" id="first_name"
                        placeholder="Nombre" disabled readonly>
                </div>

                <div class="form_group">
                    @error('last_name')
                        <p class="error">Apellido invalido</p>
                    @enderror
                    <label for="last_name">Apellido:</label>
                    <input value="{{ $user->last_name }}" type="text" name="last_name" id="last_name"
                        placeholder="Apellido" disabled readonly>
                </div>

                <div class="form_group">
                    @error('document_number')
                        <p class="error">Número de documento invalido</p>
                    @enderror
                    <label for="document_number">Número de documento:</label>
                    <input value="{{ $user->document_number }}" type="text" name="document_number" id="document_number"
                        placeholder="Sin puntos ni espacios" maxlength="12" required readonly disabled>
                </div>

                <div class="form_group">
                    @error('phone_number')
                        <p class="error">Número de teléfono invalido</p>
                    @enderror
                    <label for="phone_number">Número de teléfono:</label>
                    <input value="{{ $user->phone_number }}" type="text" id="phone_number_show"
                        placeholder="+57 3XX XXX XXXX">
                    <input value="{{ $user->phone_number }}" type="hidden" name="phone_number" id="phone_number">
                </div>
                <div class="form_group">
                    <label for="email">Correo Electrónico:</label>
                    <input value="{{ $user->email }}" type="email" id="email" name="email"
                        value="{{ old('email') }}">
                </div>

                <div class="form_group">
                    @error('address')
                        <p class="error">Dirección invalida</p>
                    @enderror
                    <label for="address">Dirección:</label>
                    <input value="{{ $user->address }}" type="text" name="address" id="address"
                        placeholder="Dirección">
                </div>

                <div class="form_group">

                    <label for="password">Contraseña:</label>
                    <div class="password_input">
                        <input type="password" class="password" name="password" placeholder="Contraseña">
                        <button type="button" id="togglePassword"><span class="icon">🙈 </span></button>
                    </div>
                </div>
                <div class="form_group">
                    <label for="password_confirmation">Confirmar Contraseña:</label>
                    <div class="password_input">
                        <input type="password" class="password" name="password_confirmation" id="password_confirmation"
                            required>
                    </div>

                    <button type="submit" class="button">Actualizar</button>
            </form>
        </div>
    </section>
@endsection
