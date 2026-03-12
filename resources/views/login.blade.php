@extends('layouts.main')

@section('title', 'login')

@section('content')

<p>ESTO ES EL LOGIN</p>
<form action="/login" method="POST">
    @csrf

    @error('not_found')
    <p class="error">{{ $message }}</p>
    @enderror

    <label for="document_number">Número de Documento:</label>
    <input type="text" name="document_number" placeholder="Número de Documento">
    <label for="password">Contraseña:</label>
    <input type="password" name="password" placeholder="Contraseña">
    <button type="submit">Iniciar Sesión</button>
</form>

@endsection



