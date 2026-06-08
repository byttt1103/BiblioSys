@extends('layouts.main')

@section('title', 'Noticia')

@section('content')
    <section class="section newsInfo">

        <div class="actions">
            <a href="{{ route('news.list') }}" class="button">
                <span class="text long medium short">Volver a lista de noticias</span>
            </a>
        </div>

        <div class="intro">
            <div class="info">
                <h1>{{ $news->title }}</h1>
                <p>{{ $news->description }}</p>
            </div>
            <div class="image">
                @if ($news->image_url)
                    <img src="{{ $news->image_url }}" alt="{{ $news->title }}">
                @endif
            </div>
        </div>
        <div class="content">
            <p>{{ $news->content }}</p>
        </div>


    </section>
@endsection
