<div class="title">
    <div class="page_info">
       <p> BiblioSys > @yield('title')</p>
    </div>
        <div class="auth_info">
        @if (Auth::user() == null)
            <a class="button" href="{{ route('login') }}">
                <span class="text">Iniciar Sesión</span>
                {{-- <span class="text long">Iniciar Sesión</span>
                <span class="text medium">Iniciar Sesión</span>
                <span class="text short">Iniciar Sesión</span> --}}
            </a>
        @else
            <a class="button" href="{{ route('logout') }}">Cerrar Sesión</a>
        @endif
    </div>
</div>
<nav>
    <ul id="libraryLinks">
        <li><a href="{{ route('index') }}">Inicio</a></li>
        <li><a href="{{ route('book.list') }}">Libros</a></li>
        <li><a href="{{ route('news.list') }}">Noticias</a></li>
        <li><a href="{{ route('about.library') }}">Sobre Nosotros</a></li>
    </ul>

</nav>
