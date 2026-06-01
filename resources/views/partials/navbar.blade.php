<div class="title">
    <div class="page_info">
        @if (!Str::contains(Request::url(), 'admin'))
            <p> BiblioSys > @yield('title')</p>
        @else
            <p> BiblioAdmin > @yield('title')</p>
        @endif
    </div>
    <div class="auth_info">
        @if (Auth::user() == null)
            <a class="button" href="{{ route('login') }}">
                <span class="text">Iniciar Sesión</span>
            </a>
            <a class="button" href="{{ route('register') }}">
                <span class="text">Registrarse</span>
            </a>
        @else
            @if (Auth::user()->roles->pluck('id')->contains(2))
                @if (!Str::contains(Request::url(), 'admin'))
                    <a class="button" href="{{ route('admin.index') }}">Dashboard</a>
                @else
                    <a class="button" href="{{ route('index') }}">Salir del Dashboard</a>
                @endif
            @endif
            <div class="dropdown">
                <button onclick="dropdown(this)" class="button dropdownBtn">
                    <svg class="dropdownBtn" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none" /><path d="M12 2a5 5 0 1 1 -5 5l.005 -.217a5 5 0 0 1 4.995 -4.783z" /><path d="M14 14a5 5 0 0 1 5 5v1a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-1a5 5 0 0 1 5 -5h4z" /></svg>
                </button>

                <div id="menu" class="dropdown-content">
                    <a class="" href="{{ route('profile') }}">Perfil</a>
                    <a class="" href="{{ route('loans.user', Auth::user()) }}">Préstamos</a>
                    <a class="" href="{{ route('logout') }}">Cerrar Sesión</a>
                </div>
            </div>

        @endif

    </div>
</div>

<nav>
    @if (!Str::contains(Request::url(), 'admin'))
        <ul id="libraryLinks">
            <li><a href="{{ route('index') }}">Inicio</a></li>
            <li><a href="{{ route('book.list') }}">Libros</a></li>
            <li><a href="{{ route('news.list') }}">Noticias</a></li>
            <li><a href="{{ route('about.library') }}">Sobre Nosotros</a></li>
        </ul>
    @else
        <ul id="libraryLinks">

            {{--? dropdown container --}}
            <div class="dropdown">
                {{--? button/anchor that toggles the dropdown menu --}}
                <a onclick="dropdown(this)" class="dropdownBtn">
                    Biblioteca <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="12px" height="12px" viewBox="0 0 12 12">
  <path d="m6,9.25c-.192,0-.384-.073-.53-.22L1.22,4.78c-.293-.293-.293-.768,0-1.061s.768-.293,1.061,0l3.72,3.72,3.72-3.72c.293-.293.768-.293,1.061,0s.293.768,0,1.061l-4.25,4.25c-.146.146-.338.22-.53.22Z" stroke-width="0" fill="rgba(122, 122, 122, 1)"></path>
</svg>
                </a>

                {{--? dropdown menu that hides or shows --}}
                <div id="menu" class="dropdown-content">
                    <a class="" href="{{ route('books.index') }}">Libros</a>
                    <li><a href="{{ route('authors.index') }}">Autores</a></li>
                    <li><a href="{{ route('categories.index') }}">Categorías</a></li>
                </div>
            </div>



            <li><a href="{{ route('news.index') }}">Noticias</a></li>
            <li><a href="{{ route('admin.loans') }}">Préstamos</a></li>
            <li><a href="{{ route('users.index') }}">Usuarios</a></li>
            @if (Auth::user()->roles->pluck('id')->contains(1))
                <li><a href="{{ route('admin.config.index') }}">Configuración</a></li>
            @endif
        </ul>
    @endif


</nav>
