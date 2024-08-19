<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'KOKOSHOP') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Angkor&family=Lilita+One&display=swap" rel="stylesheet">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/form.css') }}">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app" class="d-flex flex-column">
        <nav class="custom-header navbar navbar-expand-md navbar-light shadow-sm ">
            <div class="container">
                <a href="{{ route('home') }}">
                    <img class="logo" src="{{ asset('images/imagotipo.png') }}" alt="">
                </a>




                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest


                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        @else
                            @if (Auth::check())
                                {{-- Verifica si el usuario ha iniciado sesión --}}
                                @if (Auth::user()->id_rol == 1)
                                    {{-- Botones para el rol 1 --}}
                                    <li class="nav-item">
                                        <a href="{{ route('usuarios.index') }}" class="nav-link">{{ __('Usuarios') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('productos.index') }}"
                                            class="nav-link">{{ __('Productos') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('ventas.index') }}" class="nav-link">{{ __('Ventas') }}</a>
                                    </li>
                                @elseif(Auth::user()->id_rol == 2)
                                    {{-- Botones para el rol 2 --}}
                                @elseif(Auth::user()->id_rol == 3)
                                    {{-- Botones para el rol 3 --}}
                                    <li class="nav-item">
                                        <a href="{{ route('ventas.index') }}" class="nav-link">{{ __('Ventas') }}</a>
                                    </li>
                                @endif
                            @endif



                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} {{ Auth::user()->lastname }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Cerrar Sesión') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>


                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        @if (!Auth::check() || Auth::user()->id_rol == 1 || Auth::user()->id_rol == 2)
            <div class="container list-btn">
                <nav class="text-center nav-list">
                    <a href="{{ route('home') }}" class="d-inline-block mx-auto text-decoration-none">Principal</a>
                    <a href="{{ route('catalogo.ver') }}"
                        class="d-inline-block align-item-start mx-auto text-decoration-none">Productos</a>
                    <a href="" class="d-inline-block mx-auto text-decoration-none">Principal</a>
                    <a href="" class="d-inline-block mx-auto text-decoration-none">Principal</a>
                </nav>
            </div>
        @endif


        <main class="" style="display: flex">
            @yield('content')

        </main>
    </div>



    <div class="card text-center" style="background: #7e79ac;">
        <div class="card-header">
            <h4>Redes</h4>
        </div>
        <div class="card-footer">
            <br>
            <a href="https://wa.me/c/573219313578"><img src="IMG/logoWpp.png" width="40" height="40"></a>
            <a href="https://instagram.com/kokoshop_10?igshid=MzRlODBiNWFlZA=="><img src="IMG/Imagen ig.png"
                    width="40" height="40"></a>
            <a href="https://www.facebook.com/"><img src="IMG/facebook-logo-3-1.png" width="40"
                    height="40"></a>
            <a href="https://twitter.com/home?lang=es"><img src="IMG/Logo twitter.png" width="40"
                    height="40"></a>
            <br>
            <br>
            <style>
                h4 {
                    text-align: center;
                    color: #000000
                }
            </style>
            <div class="container-fluid">
                <div class="row p-5">
                    <div class="col-lg-3">
                        <p class="h3">KokoShop</p>
                        <img src="images/logo_koko.png" alt="" height="200" width="200">


                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-3">
                        <p class="h5">INFORMACIÓN CORPORATIVA</p>
                        <a class="text-dark" href="">Trabajar en KokoShop</a><br>
                        <a class="text-dark" href="">Contacto</a><br>


                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-3">
                        <p class="h5">AYUDA</p>
                        <a class="text-dark" href="">Servicio al cliente</a><br>
                        <a class="text-dark" href="">Términos y condiciones</a>


                    </div>
                    <div class="col-xs-12 col-md-6 col-lg-3">
                        <p class="h5">Encuéntranos</p><br>
                        <p> Dirección:Cra. 68D #13 - 54, Int 7</p><br>
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d703.0343584087746!2d-74.0817536092821!3d4.600668331058748!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e3f99093cc38f71%3A0x27144f1e1d20f13e!2sVisto%20Centro%20de%20Comercio%20Mayorista%20Internacional!5e0!3m2!1ses!2sco!4v1711107427126!5m2!1ses!2sco"
                            width=400"" height="250" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                        <br>
                        <p>Contáctanos de Lunes a Viernes de
                            8:00am a 5:00pm</p>
                    </div>
                </div>
            </div>
            <br>
            <h7 class="card-title">© TODOS LOS DERECHOS RESERVADOS</h7>
        </div>
    </div>
    </footer>
</body>

</html>
