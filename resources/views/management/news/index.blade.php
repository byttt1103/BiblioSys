<h1>Hola</h1>
@extends('layouts.main')

@section('title', 'Noticias')

@section('content')

    <div class="admin">
        <!-- if this variable is set, we show it -->
        @if (session('success'))
            <div style="color: green;">
                {{ session('success') }}
            </div>
        @endif


        @if(!$news->isEmpty())
        <a href=" {{ route('news.create') }} "><button>Crear noticia</button></a>
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
                            <a href="{{ route('news.edit', $new->id) }}"><button>Editar</button></a>

                            <form method="POST" action="{{ route('news.destroy', $new->id) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Estas seguro?')">Borrar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @else
            <p>No hay noticias actualmente: <a href=" {{ route('news.create') }} "><button>Crear noticia</button></a></p>
        @endif
    </div>
@endsection
