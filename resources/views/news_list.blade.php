@extends('layouts.main')

@section('title', 'Libros')

@section('content')

    <h1 class="mb-4">Noticias</h1>

    <form action="{{ route('news.search') }}" method="GET">
        <input type="text" name="search" placeholder="Busca una noticia" value="{{ old('search', request('search')) }}"
            required />
        <button type="submit">Buscar</button>
    </form>

    @if ($news->isEmpty())
        <p>No se encontraron noticias.</p>
    @endif

    @foreach ($news as $item)
        <div class="card mb-3">
            <div class="card-body">
                @if ($item->image_url)
                    <img src="{{ $item->image_url }}" alt="Imagen de la noticia" class="img-fluid mb-3">
                @endif
                <h5 class="card-title">{{ $item->title }}</h5>
                <p class="card-text">{{ $item->description }}</p>

                @if ($item->category)
                    <p class="category"><strong>Categoría:</strong> {{ $item->category }}</p>
                @endif

                @if ($item->tags)
                    <p>
                        @foreach (explode(',', $item->tags) as $tag)
                            <span class="badge badge-secondary">{{ trim($tag) }}</span>
                        @endforeach
                    </p>
                @endif
            </div>
        </div>
    @endforeach

@endsection
