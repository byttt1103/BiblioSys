@extends('layouts.main')

@section('title', 'Iniciar Sesión')

@section('content')
    <section class="section">
        <div class="form">
            <h1>Iniciar Sesión</h1>
            <form action="{{ route('login') }}" method="POST">
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
        </div>
    </section>
@endsection
