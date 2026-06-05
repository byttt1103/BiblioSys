@extends('layouts.main')

@section('title', 'Registrarse')

@section('content')
    <section class="section">
        <div class="container">
            <h1>Registro de Usuario</h1>
            <form action="{{ route('register') }}" method="POST">
                @csrf

            <div>
                @error('first_name')
                    <p class="error">Nombre invalido</p>
                @enderror
                <label for="first_name">Nombre:</label>
                <input type="text" name="first_name" id="first_name" placeholder="Nombre" value="{{ old('first_name') }}">
            </div>

            <div>
                @error('last_name')
                    <p class="error">Apellido invalido</p>
                @enderror
                <label for="last_name">Apellido:</label>
                <input type="text" name="last_name" id="last_name" placeholder="Apellido" value="{{ old('last_name') }}">
            </div>

            <div>
                @error('document_number')
                    <p class="error">Número de documento invalido</p>
                @enderror
                <label for="document_number">Número de documento:</label>
                <input type="text" name="document_number" id="document_number" placeholder="Sin puntos ni espacios"
                    maxlength="10"  required value="{{ old('document_number') }}">
            </div>

            <div>
                @error('phone_number')
                    <p class="error">Número de teléfono invalido</p>
                @enderror
                <label for="phone_number">Número de teléfono:</label>
                <input type="text" id="phone_number_show" placeholder="+57 3XX XXX XXXX" value="{{ old('phone_number') }}" required>
                <input type="hidden" name="phone_number" id="phone_number" value="{{ old('phone_number') }}">
            </div>
            <div>
                <label for="email">Correo Electrónico:</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}">
            </div>

            <div>
                @error('address')
                    <p class="error">Dirección invalida</p>
                @enderror
                <label for="address">Dirección:</label>
                <input type="text" name="address" id="address" placeholder="Dirección" value="{{ old('address') }}">
            </div>

            <div>
                @error('password')
                    <p class="error">Contraseña invalida</p>
                @enderror
                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" required>

            </div>
             <div>
                <label for="password_confirmation">Confirmar Contraseña:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required>
            </div>
                <button type="submit" class="button">Registrarse</button>
            </form>
        </div>
    </section>
@endsection
