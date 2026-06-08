@extends('layouts.main')

@section('title', 'Perfil')

@section('content')
    <section class="section">
        <div class="profile">
            <h3>Tu perfil</h3>
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('PUT')


            <div>
                @error('first_name')
                    <p class="error">Nombre invalido</p>
                @enderror
                <label for="first_name">Nombre:</label>
                <input value="{{ $user->first_name }}" type="text" name="first_name" id="first_name" placeholder="Nombre" disabled readonly>
            </div>

            <div>
                @error('last_name')
                    <p class="error">Apellido invalido</p>
                @enderror
                <label for="last_name">Apellido:</label>
                <input value="{{ $user->last_name }}" type="text" name="last_name" id="last_name" placeholder="Apellido" disabled readonly>
            </div>

            <div>
                @error('document_number')
                    <p class="error">Número de documento invalido</p>
                @enderror
                <label for="document_number">Número de documento:</label>
                <input value="{{ $user->document_number }}" type="text" name="document_number" id="document_number" placeholder="Sin puntos ni espacios"
                    maxlength="12"  required readonly disabled>
            </div>

            <div>
                @error('phone_number')
                    <p class="error">Número de teléfono invalido</p>
                @enderror
                <label for="phone_number">Número de teléfono:</label>
                <input value="{{ $user->phone_number }}" type="text" id="phone_number_show" placeholder="+57 3XX XXX XXXX">
                <input value="{{ $user->phone_number }}" type="hidden" name="phone_number" id="phone_number">
            </div>
            <div>
                <label for="email">Correo Electrónico:</label>
                <input value="{{ $user->email }}"  type="email" id="email" name="email" value="{{ old('email') }}">
            </div>

            <div>
                @error('address')
                    <p class="error">Dirección invalida</p>
                @enderror
                <label for="address">Dirección:</label>
                <input value="{{ $user->address }}" type="text" name="address" id="address" placeholder="Dirección">
            </div>

            <div>
            <div>
                <h4>Cambiar contraseña</h4>
                    @error('password')
                        <p class="error">Contraseña invalida</p>
                    @enderror
                    <label for="password">Cambiar contraseña:</label>
                    <input type="password" name="password" id="password" placeholder="Password">

                </div>
                <div>
                    <label for="password_confirmation">Confirmar Contraseña:</label>
                    <input type="password" id="password_confirmation" name="password_confirmation">
                </div>
            </div>
                <button type="submit" class="button">Actualizar</button>
            </form>
        </div>
    </section>
@endsection
