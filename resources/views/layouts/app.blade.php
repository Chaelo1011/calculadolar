<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title')</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        <link rel="dns-prefetch" href="https://kit.fontawesome.com/">
        <script src="https://kit.fontawesome.com/8063777d0a.js" crossorigin="anonymous" async></script>
        <script src="{{ asset('js/sys.js') }}" defer></script>
        

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
            <div class="wait row justify-content-center">
                <div class="col-md-12">
                    <div class="spinner"></div>
                </div>
            </div>
            <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{asset('img/iconoDolar.jpg')}}" class="mr-2" alt="" height="30">{{ config('app.name') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <!-- Left Side Of Navbar -->
                        <ul class="navbar-nav mr-auto">

                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="navbar-nav ml-auto">
                            <!-- Authentication Links -->
                            @guest
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                    </li>
                                @endif
                            @else
                                <li class="nav-item">
                                    <a href="{{route('home')}}" class="nav-link" role="button">
                                        Inicio
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('products.index')}}" class="nav-link" role="button">
                                        Productos
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('invoice.index')}}" class="nav-link" role="button">
                                        Ventas
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{route('customers.index')}}" class="nav-link" role="button">
                                        Clientes
                                    </a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
                                    
                                    
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        @if(count(Auth::user()->business)>0)
                                            <a class="dropdown-item" href="{{ route('business.edit', Auth::user()->business[0]->id) }}">
                                                {{ __('Datos de mi negocio') }}
                                            </a>
                                        @endif

                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Cerrar sesión') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endguest
                        </ul>
                    </div>
                </div>
            </nav>

            <main class="py-4">
                @yield('content')
            </main>

            @guest
            @else
                <footer>
                    <div class="container">
                        <span>Desarrollado por IsaelGP &copy; 2021  &nbsp;&nbsp;<a href="javascript:;" id="enlaceContacto">Contacto</a> &nbsp;&nbsp;V1.7.1</span>
                    </div>
                </footer>
            @endguest
        </div>
        @yield('scripts')
    </body>
</html>
