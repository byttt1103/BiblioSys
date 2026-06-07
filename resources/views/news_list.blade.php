@extends('layouts.main')

@section('title', 'Noticias')

@section('content')
    <section class="section">
        <h1>Noticias</h1>
        <div class="section__search">
            @include('partials.search', [
                'action' => route('news.search'),
                'placeholder' => 'Busca una noticia',
                'search' => old('search', request('search')),
                'required' => true,
            ])
        </div>

        @if ($news->isEmpty())
            <p>No se encontraron noticias.</p>
        @else
            <div class="grid">
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
                                <p class="text long medium">
                                    Ver más <span aria-hidden="true">🠲</span>
                                </p>
                                <p class="text short" aria-hidden="true">Más 🠲</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="paginator">
                {{ $news->links('partials.pagination') }}
            </div>
        @endif
    </section>

@endsection
