@extends('layouts.admin')

@section('title', 'Noticias')

@section('content')
    <section class="section admin">
        <div class="admin_actions">
            <a href="{{ route('news.create') }}" class="button button-small">
                <span class="text long medium short">Crear noticia</span>
            </a>
            <a href="{{ route('admin.index') }}" class="button button-small">
                <span class="text long medium">Volver al inicio</span>
                <span class="text short">Inicio</span>
            </a>
        </div>
        <div class="searchBar">
            @include('partials.search', [
                'action' => route('news.index'),
                'placeholder' => 'Busca una noticia',
                'search' => old('search', request('search')),
            ])
        </div>
        <h1>Noticias</h1>

        @if (!$news->isEmpty())
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Imagen</th>
                        <th>Categoría</th>
                        <th>Etiquetas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($news as $singleNews)
                        <tr>
                            <td>{{ $singleNews->id }}</td>
                            <td>{{ $singleNews->title }}</td>
                            <td>{{ $singleNews->description }}</td>
                            <td>
                                @if ($singleNews->image_url)
                                    <img src="{{ $singleNews->image_url }}" alt="{{ $singleNews->title }}"
                                        style="max-width: 100px; max-height: 60px;">
                                @endif
                            </td>
                            <td>{{ $singleNews->category }}</td>
                            <td>{{ $singleNews->tags }}</td>
                            <td>
                                <div class="admin_actions">
                                    <a href="{{ route('news.edit', $singleNews->id) }}" class="button button-small">
                                        <div class="text">Editar</div>
                                    </a>
                                    <form method="POST" action="{{ route('news.destroy', $singleNews->id) }}"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button button-small button-danger"
                                            onclick="return confirm('Estas seguro?')">
                                            <div class="text">Borrar</div>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No hay noticias actualmente.</p>
        @endif
    </section>
@endsection
