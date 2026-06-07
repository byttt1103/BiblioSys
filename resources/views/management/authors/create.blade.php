@extends('layouts.admin')

@section('title', 'Crear autor')

@section('content')
    <section class="section admin">
        <div class="admin_actions">
            <a href="{{ route('authors.index') }}" class="button button-small"><span class="text long medium short">Volver a los autores</span></a>
        </div>

        <div class="form">
            <h1>Crear autor</h1>
            <form action="{{ route('authors.store') }}" method="POST">
                @csrf

                @error('not_found')
                    <p class="error">{{ $message }}</p>
                @enderror
                <div class="form_group">
                    <label for="name">Nombre del autor</label>
                    <input type="text" name="name" maxlength="255" placeholder="Escribe el nombre del autor aquí"
                        required value="{{ old('name') }}">
                </div>
                <div class="form_group">
                    <label for="biography">Biografía</label>
                    <textarea name="biography" placeholder="Escribe la biografía aquí" required>{{ old('biography') }}</textarea>
                </div>

                <button type="submit">Crear autor</button>
            </form>
        </div>
    </section>
@endsection
