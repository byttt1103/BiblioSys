@extends('layouts.main')

@section('title', 'register')

@section('content')

<div class="container">
    <h1>Registro de Usuario</h1>
    <form action="/register" method="POST">
        @csrf

        @error('first_name')
            <p class="error">Nombre invalido</p>
        @enderror
        <label for="first_name">Nombre:</label>
        <input type="text" name="first_name" placeholder="Nombre">

        @error("last_name")
            <p class="error">Apellido invalido</p>
        @enderror
        <label for="last_name">Apellido:</label>
        <input type="text" name="last_name" placeholder="Apellido">

        @error("document_number")
            <p class="error">Número de documento invalido</p>
        @enderror
        <label for="document_number">Número de documento:</label>
        <input type="text" name="document_number" placeholder="Número de Documento">

        @error("phone_number")
            <p class="error">Número de teléfono invalido</p>
        @enderror
        <label for="phone_number">Número de teléfono:</label>
        <input type="text" name="phone_number" placeholder="Número de Teléfono">

        @error("address")
            <p class="error">Dirección invalida</p>
        @enderror
        <label for="address">Dirección:</label>
        <input type="text" name="address" placeholder="Dirección">

        @error("password")
            <p class="error">Contraseña invalida</p>
        @enderror
        <label for="password">Contraseña:</label>
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Registrar</button>
    </form>
</div>

@endsection
