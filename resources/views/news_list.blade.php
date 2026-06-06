@extends('layouts.main')

@section('title', 'Noticias')

@section('content')
    <section class="section">
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
             <div class="card">
                 <div class="card__body">
                     @if ($item->image_url)
                         <img src="{{ $item->image_url }}" alt="Imagen de la noticia" class="card__image">
                     @endif
                     <h5 class="card__title">{{ $item->title }}</h5>
                     <p class="card__text">{{ $item->description }}</p>

                     @if ($item->category)
                         <p class="card__category"><strong>Categoría:</strong> {{ $item->category }}</p>
                     @endif

                     @if ($item->tags)
                            <p class="card__tags">
                                @foreach (explode(',', $item->tags) as $tag)
                                    <span class="badge">{{ trim($tag) }}</span>
                                @endforeach
                             </p>
                         @endif
                     </div>
                 </div>
            @endforeach
            </div>
        @endif
    </section>

@endsection
