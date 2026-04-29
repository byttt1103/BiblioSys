@extends('layouts.main')

@section('title', 'Sobre Nosotros')

@section('content')
    <div class="about">
        <div class="section description">
            <h1>Sobre Nosotros - {{ $library->name }}</h1>
            <p>{{ $library->description }}</p>
        </div>
        <div class="section">
            <div class="peopleInfo">
                <h2>Nuestro Equipo</h2>
                <p>Conoce a las personas que hacen posible nuestra biblioteca.</p>
                <div class="peopleBox">
                    <div>
                        <h3>Propietario</h3>
                        <p>{{ $library->founder->first_name }}</p>
                    </div>

                    <div>
                        <h3>Personal</h3>
                        @foreach ($staff as $member)
                            <div>
                                <h5>{{ $member->first_name }}</h5>
                                <p>Correo Electrónico: {{ $member->email }}</p>
                                <p>Teléfono de contacto: {{ $member->phone_number }}</p>
                            </div>
                        @endforeach
                    </div>

                </div>

            </div>
            <div class="schedule">
                <table>
                    <thead>
                        <tr>
                            <th>Días</th>
                            <th>Horario de Apertura</th>
                            <th>Horario de Cierre</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Lunes a Viernes</td>
                            <td>{{$library->opening_hour_weekday}}</td>
                            <td>{{$library->closing_hour_weekday}}</td>
                        </tr>
                        <tr>
                            <td>Sábados</td>
                            <td>{{$library->opening_hour_weekend}}</td>
                            <td>{{$library->closing_hour_weekend}}</td>
                        </tr>
                        <tr>
                            <td>Domingos</td>
                            <td>No hay servicio</td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>


@endsection
