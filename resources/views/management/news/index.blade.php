@extends('layouts.admin')

@section('title', 'Noticias')

@section('content')
    <section class="section admin">
        <div class="admin__actions">
            <a href="{{ route('news.create') }}" class="button">
                <span class="text long medium short">Crear noticia</span>
            </a>
        </div>
        <div class="section__search">
            @include('partials.search', [
                'action' => route('news.index'),
                'placeholder' => 'Busca una noticia',
                'search' => old('search', request('search')),
            ])
        </div>

        @if(!$news->isEmpty())
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
                    @foreach ($news as $new)
                        <tr>
                            <td>{{ $new->id }}</td>
                            <td>{{ $new->title }}</td>
                            <td>{{ $new->description }}</td>
                            <td>
                                @if ($new->image_url)
                                    <img src="{{ $new->image_url }}" alt="{{ $new->title }}"
                                        style="max-width: 100px; max-height: 60px;">
                                @endif
                            </td>
                            <td>{{ $new->category }}</td>
                            <td>{{ $new->tags }}</td>
                            <td>
                                <div class="admin__actions">
                                    <a href="{{ route('news.edit', $new->id) }}" class="button button-small">Editar</a>
                                    <form method="POST" action="{{ route('news.destroy', $new->id) }}" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="button button-small button-danger" onclick="return confirm('Estas seguro?')">Borrar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>No hay noticias actualmente: <a href=" {{ route('news.create') }} "><button>Crear noticia</button></a></p>
        @endif
    </section>
@endsection
