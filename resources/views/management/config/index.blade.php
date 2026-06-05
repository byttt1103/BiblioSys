@extends('layouts.admin')

@section('title', 'Configuración')

@section('content')
    <section class="section admin">
        <div class="config">
            <h3>Configuración de la web</h3>
            <form action="{{ route('admin.config.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div>
                    @error('name')
                        <p class="error">Nombre inválido</p>
                    @enderror
                    <label for="name">Nombre:</label>
                    <input type="text" name="name" id="name" placeholder="Nombre"
                        value="{{ old('name', $config->name ?? '') }}">
                </div>

                <div>
                    @error('address')
                        <p class="error">Dirección inválida</p>
                    @enderror
                    <label for="address">Dirección:</label>
                    <input type="text" name="address" id="address" placeholder="Dirección"
                        value="{{ old('address', $config->address ?? '') }}">
                </div>

                <div>
                    @error('phone_number')
                        <p class="error">Número de teléfono inválido</p>
                    @enderror
                    <label for="phone_number">Número de teléfono:</label>
                    <input type="tel" name="phone_number" id="phone_number" placeholder="+57 3XX XXX XXXX"
                        value="{{ old('phone_number', $config->phone_number ?? '') }}">
                </div>

                <div>
                    @error('email')
                        <p class="error">Correo electrónico inválido</p>
                    @enderror
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" name="email" id="email" placeholder="Correo electrónico"
                        value="{{ old('email', $config->email ?? '') }}">
                </div>

                <div>
                    @error('description')
                        <p class="error">Descripción inválida</p>
                    @enderror
                    <label for="description">Descripción:</label>
                    <textarea name="description" id="description" placeholder="Descripción">{{ old('description', $config->description ?? '') }}</textarea>
                </div>

                <h4>Horario de atención</h4>

                <div>
                    @error('opening_hour_weekday')
                        <p class="error">Hora de apertura en días de semana inválida</p>
                    @enderror
                    <label for="opening_hour_weekday">Hora de apertura (días de semana):</label>
                    <input type="time" name="opening_hour_weekday" id="opening_hour_weekday"
                        value="{{ old('opening_hour_weekday', substr($config->getRawOriginal('opening_hour_weekday') ?? '', 0, 5)) }}">
                </div>

                <div>
                    @error('closing_hour_weekday')
                        <p class="error">Hora de cierre en días de semana inválida</p>
                    @enderror
                    <label for="closing_hour_weekday">Hora de cierre (días de semana):</label>
                    <input type="time" name="closing_hour_weekday" id="closing_hour_weekday"
                        value="{{ old('closing_hour_weekday', substr($config->getRawOriginal('closing_hour_weekday') ?? '', 0, 5)) }}">
                </div>

                <div>
                    @error('opening_hour_weekend')
                        <p class="error">Hora de apertura en fines de semana inválida</p>
                    @enderror
                    <label for="opening_hour_weekend">Hora de apertura (fines de semana):</label>
                    <input type="time" name="opening_hour_weekend" id="opening_hour_weekend"
                        value="{{ old('opening_hour_weekend', substr($config->getRawOriginal('opening_hour_weekend') ?? '', 0, 5)) }}">
                </div>

                <div>
                    @error('closing_hour_weekend')
                        <p class="error">Hora de cierre en fines de semana inválida</p>
                    @enderror
                    <label for="closing_hour_weekend">Hora de cierre (fines de semana):</label>
                    <input type="time" name="closing_hour_weekend" id="closing_hour_weekend"
                        value="{{ old('closing_hour_weekend', substr($config->getRawOriginal('closing_hour_weekend') ?? '', 0, 5)) }}">
                </div>
                <button type="submit" class="button">Actualizar</button>
            </form>
        </div>
    </section>
@endsection
