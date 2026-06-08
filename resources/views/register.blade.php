@extends('layouts.main')

@section('title', 'Registrarse')

@section('content')
    <section class="section">
        <div class="form">
            <h1>Registrarse</h1>
            <form action="{{ route('register') }}" method="POST">
                @csrf

                <div class="form_group">
                    <label for="first_name">Nombre:</label>
                    <input type="text" name="first_name" id="first_name" placeholder="Nombre"
                        value="{{ old('first_name') }}">
                </div>

                <div class="form_group">
                    <label for="last_name">Apellido:</label>
                    <input type="text" name="last_name" id="last_name" placeholder="Apellido"
                        value="{{ old('last_name') }}">
                </div>

                <div class="form_group">
                    <label for="document_number">Número de documento:</label>
                    <input type="text" name="document_number" id="document_number" placeholder="Sin puntos ni espacios"
                        maxlength="10" required value="{{ old('document_number') }}">
                </div>

                <div class="form_group">
                    <label for="phone_number">Número de teléfono:</label>
                    <input type="text" id="phone_number_show" placeholder="+57 3XX XXX XXXX"
                        value="{{ old('phone_number') }}" required>
                    <input type="hidden" name="phone_number" id="phone_number" value="{{ old('phone_number') }}">
                </div>
                <div class="form_group">

                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}">
                </div>

                <div class="form_group">

                    <label for="address">Dirección:</label>
                    <input type="text" name="address" id="address" placeholder="Dirección"
                        value="{{ old('address') }}">
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
                        <input type="password" class="password" name="password_confirmation" id="password_confirmation" required>
                    </div>

                </div>
                    <button type="submit" class="button"><span class="text">Registrarse</span></button>

    </section>
@endsection
