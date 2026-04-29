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

    <div class="section new">
        <h2>Novedades</h2>

        @if ($new)
            <div class="card mb-3">
                <div class="card-body">
                    @if ($new->image_url)
                        <img src="{{ $new->image_url }}" alt="Imagen de la noticia" class="img-fluid mb-3">
                    @endif
                    <h5 class="card-title">{{ $new->title }}</h5>
                    <p class="card-text">{{ $new->description }}</p>

                    @if ($new->category)
                        <p class="category"><strong>Categoría:</strong> {{ $new->category }}</p>
                    @endif

                    @if ($new->tags)
                        <p>
                            @foreach (explode(',', $new->tags) as $tag)
                                <span class="badge badge-secondary">{{ trim($tag) }}</span>
                            @endforeach
                        </p>
                    @endif
                </div>
            </div>
        @endif
    </div>

    <div class="section services">
        <h2>Servicios</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <!-- Books panel -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Libros</h5>
                    <p class="card-text">Explora nuestra colección de libros.</p>
                    <a href="{{ route('book.list') }}" class="btn btn-primary">Ver libros</a>
                </div>
            </div>

            <!-- News panel -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Noticias</h5>
                    <p class="card-text">Mantente informado con las últimas novedades.</p>
                    <a href="{{ route('news.list') }}" class="btn btn-primary">Ver noticias</a>
                </div>
            </div>

            <!-- Loans panel -->
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Mis Préstamos</h5>
                    <p class="card-text">Consulta el estado de tus préstamos.</p>
                    @if(Auth::check())
                        <a href="{{ route('loans.user', Auth::user()->id) }}" class="btn btn-primary">Ver mis préstamos</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary">Iniciar sesión para ver mis préstamos</a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="section about">
        <h2>¿Quiénes somos?</h2>
        <p>Somos una biblioteca dedicada a proporcionar acceso a una amplia variedad de libros y recursos educativos para la
            comunidad. Nuestro objetivo es fomentar el amor por la lectura y el aprendizaje, ofreciendo un espacio acogedor
            y recursos de calidad para todos los visitantes.</p>
    </div>


@endsection
