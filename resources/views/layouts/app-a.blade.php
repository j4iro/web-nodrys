<!DOCTYPE html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png"  href="{{asset('images/favicon/favicon.png')}}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    <style>


    .dropdown-toggle_down::after{

          -ms-transform: rotate(90deg); /* IE 9 */
          -webkit-transform: rotate(90deg); /* Safari */'
          transform: rotate(90deg);
    }

    .nested {
      display: none;
    }

    .active {
      display: block;
    }

    .btn-group{
        width: 100%;
    }
    .dropdown-menu{
        position: absolute;
        /* transform: translate3d(111px, 0px, 0px); */
        top: 0px; left: 0px;
        will-change: transform;
    }
    </style>
    @yield('scripts')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand p-0" href="{{ route('admin.index') }}">
                    {{-- config('app.name', 'Laravel') --}}
                    <img class="p-0 img-fluid" src="{{asset('svg/logo.svg')}}" width="40" alt="Nodrys">
                    <strong>Panel Administrador</strong>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

            </div>
        </nav>

        <main class="py-4">
            <div class="container-fluid mt-3">
                <div class="row">
                    @include('includes/slidebar-admin')
                <div class="col-12 col-md-9 col-lg-10 mb-3">
                    @yield('content')
                </div>
            </div>
        </div>
        </main>
    </div>
    <script>

        var toggler = document.getElementsByClassName("dropdown-toggle");
        var i;
        for (i = 0; i < toggler.length; i++) {
          toggler[i].addEventListener("click", function() {
              var actual=i;
              for (i = 0; i < toggler.length; i++) {
                  if (this.innerHTML!=toggler[i].innerHTML) {
                      pliega(toggler[i]);
                  }

              }
              despliega(this);
          });

        }

        function despliega(objeto){
            objeto.parentElement.querySelector(".nested").classList.toggle("active");
            objeto.classList.toggle("dropdown-toggle_down");
        }
        function pliega(objeto) {
            toggler[i].classList.remove('dropdown-toggle_down');
            toggler[i].parentElement.querySelector(".nested").classList.remove("active");
        }

    </script>
</body>
</html>
