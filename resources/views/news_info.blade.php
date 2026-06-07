@extends('layouts.main')

@section('title', 'Noticia')

@section('content')
    <section class="section">
        <h1>{{ $news->title }}</h1>
        <div class="section__content">
            <p>{{ $news->description }}</p>
        </div>
    </section>
@endsection
