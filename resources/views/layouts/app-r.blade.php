<!DOCTYPE html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Panel Restaurantes</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.min.js">

    </script>

    <script type="text/javascript">

        function cambiardisponibilidad()
        {
            var finalUrl = {!! json_encode(url('/')) !!}+ "/admin-restaurante/cambiar-disponibilidad";
            $.get( finalUrl,function( data ) {
                if(data=="0"){
                    labeldisponibilidad.innerHTML = "CERRADO";
                }else{
                    labeldisponibilidad.innerHTML = "ABIERTO";
                }
              //  alert(data);
            });
        }
    </script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png"  href="{{asset('images/favicon/favicon.png')}}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand p-0" href="{{ route('adminRestaurant.index') }}">
                    {{-- config('app.name', 'Laravel') --}}
                    <img class="p-0 img-fluid" src="{{asset('svg/logo.svg')}}" width="40" alt="Nodrys">
                <strong>Restaurante {{session('nombre_restaurante')}}</strong>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
                <div class="container-fluid mt-3">
                        <div class="row ">

                        @include('includes/slidebar')

                            <div class="col-12 col-md-9 col-lg-10 mb-3">
                                @yield('content')
                            </div>
                        </div>
                </div>
        </main>
    </div>
    @yield('scripts')

</body>
</html>
