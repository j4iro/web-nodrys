<!DOCTYPE html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title')
    </title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Favicon -->
    <link rel="icon" type="image/png"  href="{{asset('images/favicon/favicon.png')}}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.min.js"></script> --}}
    <script type="text/javascript" src="{{asset('js/jquery-3.4.0.min.js')}}"></script>
    @yield('scripts')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel sticky-top">
            <div class="container">
                <a class="navbar-brand p-0" href="{{ url('/') }}">
                    {{-- config('app.name', 'Laravel') --}}
                    <img class="p-0 img-fluid" src="{{asset('svg/logo.svg')}}" width="40" alt="Nodrys">
                    <strong>Nodrys</strong>

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
                                <a href="{{ route('home')}}"  class="nav-link">Restaurantes</a>
                            </li class="nav-item">
                            <li class="nav-item">
                                <a href="{{ route('getAllDishes')}}"  class="nav-link">Platos</a>
                            </li class="nav-item">
                            <li>
                                <a href="{{route('carrito.index')}}"  class="nav-link">Mi Carrito
                                    @if (isset($_SESSION['carrito']) && count($_SESSION['carrito'])>=1)
                                        <span class="badge badge-warning ">{{count($_SESSION['carrito'])}}</span>
                                    @else
                                        <span class="badge badge-warning">0</span>
                                    @endif
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('help')}}"  class="nav-link">Ayuda</a>
                            </li class="nav-item">
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Iniciar Sesión') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registrarse') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a href="{{ route('home')}}"  class="nav-link">Restaurantes</a>
                            </li class="nav-item">
                            <li class="nav-item">
                                <a href="{{ route('getAllDishes')}}"  class="nav-link">Platos</a>
                            </li class="nav-item">
                            <li>
                                <a href="{{route('carrito.index')}}"  class="nav-link">Mi Carrito
                                    @if (isset($_SESSION['carrito']) && count($_SESSION['carrito'])>=1)
                                        <span class="badge badge-warning ">{{count($_SESSION['carrito'])}}</span>
                                    @else
                                        <span class="badge badge-warning">0</span>
                                    @endif
                                </a>
                            </li>
                            <li>
                                <a href="{{route('pedidos.index')}}"  class="nav-link">Mis Pedidos
                                    {{-- <span class="badge badge-warning mb-1">0</span> --}}
                                </a>
                            </li>
                            <li>
                                {{-- <a href="{{route('favoritos.index')}}"  class="nav-link">Mis Favoritos
                                </a> --}}
                            </li>



                            <li>
                                @if(auth()->user()->hasRoles(['admin']))
                                        <a target="_blank" href="{{route('admin.index')}}" class="nav-link">Panel Administrador Master</a>
                                @endif
                            </li>
                            <li>
                                @if(auth()->user()->hasRoles(['admin-restaurant']))
                                        <a target="_blank" href="{{route('adminRestaurant.index')}}" class="nav-link">Restaurant administrator</a>
                                @endif
                            </li>


                            <li class="ml-0 ml-sm-3">
                                @include('includes.avatar')
                            </li>

                            {{-- <li class="nav-item dropdown">

                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                     <span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('config') }}">
                                        Mi Perfil
                                    </a>

                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        Salir
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li> --}}

                            <li>
                                <a  href="{{ route('config') }}" class="nav-link">{{ Auth::user()->name }}</a>
                            </li>

                            <li>
                                <a class="nav-link text-danger" href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                      document.getElementById('logout-form').submit();">
                                   <img src="{{asset('images/icons/icon-exit.png')}}" width="20">
                               </a>
                               <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                   @csrf
                               </form>
                          </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="p-0">
            @yield('content')
        </main>
    </div>
    <script type="text/javascript">
    var navbar_botton=document.querySelector(".navbar-toggler")
    navbar_botton.addEventListener('click',function (){
        navbarSupportedContent.classList.toggle("navbar-show");
    });
   
    </script>
</body>
</html>
