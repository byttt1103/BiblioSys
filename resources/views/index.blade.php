@extends('layouts.main')

@section('title', 'Inicio')

@section('content')

    {{-- ===== HERO SECTION ===== --}}
    <div class="section header">

        <div id="greeter">
            <div class="greeter_text">
                @if (Auth::user() == null)
                    <h1>Bienvenido a {{ $library->name }}</h1>
                @else
                    <h1>Bienvenido, {{ Auth::user()->first_name }}.</h1>
                @endif
                <p class="greeter_subtitle">Explora nuestra biblioteca y descubre los mejores libros.</p>
            </div>

            <div class="searchBar">
                @include('partials.search', [
                    'action' => route('book.search'),
                    'placeholder' => 'Busca...',
                    'search' => old('search', request('search')),
                    'mode' => 'books',
                    'categories' => $categories ?? collect(),
                    'selectedCategories' => request('categories', []),
                ])
            </div>
        </div>

        <div class="services">
            <h2>Servicios</h2>
            <div class="services_grid">

                {{-- Books panel --}}
                <div class="elementBox">
                    <div class="info">
                        <h4>Libros</h4>
                        <p>Explora nuestra colección de libros.</p>
                        <div class="actions">
                            <a href="{{ route('book.list') }}" class="button button_small">
                                <span class="text">Ver libros</span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- News panel --}}
                <div class="elementBox">
                    <div class="info">
                        <h4>Noticias</h4>
                        <p>Mantente informado con las últimas novedades.</p>
                        <div class="actions">
                            <a href="{{ route('news.list') }}" class="button button_small">
                                <span class="text">Ver noticias</span>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Loans panel --}}
                <div class="elementBox">
                    <div class="info">
                        <h4>Mis Préstamos</h4>
                        <p>Consulta el estado de tus préstamos.</p>
                        <div class="actions">
                            @if (Auth::check())
                                <a href="{{ route('loans.user', Auth::user()->id) }}" class="button button_small">
                                    <span class="text">Ver mis préstamos</span>
                                </a>
                            @else
                                <a href="{{ route('login') }}" class="button button_small">
                                    <span class="text">Inicia sesión</span>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

            </div>

            <div class="about">
                <div class="dividerShort"></div>
                <h3>¿Quiénes somos?</h3>
                <p>{{ $library->description }}</p>
            </div>
        </div>

    </div>

    {{-- ===== NEWS SECTION ===== --}}
    <div class="section">
        <h2>Novedades</h2>
        <div class="news">
            @foreach ($news as $item)
                <div class="elementBox">

                    @if ($item->image_url)
                        <div class="newsImage">
                            <img src="{{ $item->image_url }}" alt="Imagen de la noticia">
                        </div>
                    @endif

                    <div class="info">
                        <h2>{{ $item->title }}</h2>
                        @if ($item->category)
                            <p class="category"><strong>Categoría:</strong> {{ $item->category }}</p>
                        @endif
                        <p>{{ $item->description }}</p>

                        @if ($item->tags)
                            <p class="tags">
                                @foreach (explode(',', $item->tags) as $tag)
                                    <span class="badge">{{ trim($tag) }}</span>
                                @endforeach
                            </p>
                        @endif
                    </div>

                    <div class="actions">
                        <a class="button news_info" href="{{ route('news.info', ['news_id' => $item->id]) }}">
                            <p class="text long medium">Ver más <span aria-hidden="true">🠲</span></p>
                            <p class="text short" aria-hidden="true">Más 🠲</p>
                        </a>
                    </div>

                </div>
            @endforeach
        </div>
    </div>

@endsection
