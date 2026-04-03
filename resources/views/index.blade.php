@extends('layouts.main')

@section('title', 'Inicio')

@section('content')
    <div class="section greeter">
        <div class="header">
            <div id="start_banner">
                @if (Auth::user() == null)
                    <h1>Bienvenido a la biblioteca</h1>
                @else
                    <h1>Bienvenido a la biblioteca, {{ Auth::user()->first_name }}.</h1>
                @endif
            </div>
            <div id="start_mosaic">

            </div>
        </div>
    </div>

@endsection
