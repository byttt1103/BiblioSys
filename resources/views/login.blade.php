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
                <div class="form_group">
                    <label for="document_number">Numero de Documento:</label>
                    <input type="text" id="document_number" name="document_number" maxlength="10" pattern="[0-9]{1,10}"
                        placeholder="Sin puntos ni espacios"required>
                </div>
                <div class="form_group">
                    <label for="password">Contraseña:</label>
                    <div class="password_input">
                        <input type="password" id="password" name="password" placeholder="Contraseña">
                        <button type="button" id="togglePassword"><span class="icon">🙈 </span></button>
                    </div>

                </div>


                <button type="submit"><span class="text">Iniciar Sesión</span></button>
            </form>
        </div>
    </section>
@endsection
