@extends('layouts.main')

@section('title', '{{ $book->title }}')

@section('content')
    <div class="section">
        {{ $book }}
    </div>

@endsection
