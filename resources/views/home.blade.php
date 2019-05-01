@extends('layouts.app')
@section('scripts')

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
    integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
    crossorigin=""/>

     <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
    integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
    crossorigin=""></script>

    {{-- <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.min.js">;
    </script> --}}

    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <style media="screen">

        .btnActual{
            position: absolute;
            z-index: 99;
            right: 0;
        }
        #map{
            height: 400px;
            /* transition: 0.5s; */
        }
        #btnActual{
            display: block;
        }
        #map.show{
        height: 0px;
        transition: 0.5s;
        }
        #btnActual.show{
            display: none;
            transition: 0.5s;
        }

    </style>
@endsection

@section('content')

<form action="{{route('restaurant.buscar')}}" method="post">
<div class="container-fluid ">
            {{csrf_field()}}

        <div class="row bg-intro  d-flex justify-content-center align-items-center">
            <div class="col-12 col-sm-8 col-md-5 text-center">
                <div class="input-group mb-2">
                    <input type="text" name="name" class="form-control form-control-lg" placeholder="Busca restaurantes por su nombre" >
                    <div class="input-group-append">
                        <button class="btn btn-dark btn-lg" name="buscar" type="submit">Buscar</button>
                    </div>
                </div>
                <strong><a href="/solicitud-unirse">¿Tienes un restaurante? Registrate aquí</a></strong>
                <br>
                <button id="btnShow" type="button"  class="btn btn-dark">
                    Ver cercanos a mí
                </button>
            </div>
        </div>

</div>
</form>


<div class="container my-4">
    <form action="{{route('restaurants.filtro')}}" method="post">

    <div class="row">
        <div class="col-12 ">
            <strong class="navbar-brand">Busca entre {{count($restaurants)}} restaurantes para tí</strong>
        </div>
    </div>

    <div id="mapa_oculto" class="mb-5">
        <div id="contenedor_mapa" class="container p-0 shadow">

            <div class="d-none">
                Latitud : <input type="text" name="txtlati" id="txtlati">
                Longitud : <input type="text" name="txtlong" id="txtlong">
            </div>

            <div class="map_container">
                <div id="map">

                </div>
            </div>
        </div>
        <button id="btnActual" class="btn btn-primary btn-actual p-1 " type="button" class="btnActual" name="button" onclick="localizar()">
            <img src="{{asset('images/icons/actualizacion-de-ubicacion.png')}}" width="25" height="inherid">
        </button>
    </div>


    <div class="row mb-4 mt-2">
            {{csrf_field()}}
        <div class="col-6 col-lg-3 pt-2">
            <select name="categoria" class="form-control" id="">
                <option value="" disabled selected >Categorias</option>
                @foreach ($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6 col-lg-3 pt-2">
            <select name="distrito" class="form-control" id="">
                <option value="" disabled selected >Distritos</option>
                @foreach ($distritos as $distrito)
                    <option value="{{$distrito->id}}">{{$distrito->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-6 col-lg-2  pt-2">
            <button class="btn btn-outline-dark" name="filtrar" type="submit">Filtrar</button>
        </div>
        </form>
    </div>


    @isset ($resultado)
        <div class="row">
            <div class="col-12 ">
                <div class="alert alert-success">
                        <strong> {{$resultado}} <a href="{{route('home')}}">Ver todos</a></strong>
                </div>
            </div>
        </div>
    @endisset

    <div class="row mt-1">
        @foreach ( $restaurants as $restaurant )

            <div class="col-12 col-md-6 col-lg-4 mb-4 ">
                <a href="{{ route('restaurant.detalle',["id"=>$restaurant->id,"nombre"=>strtolower(implode("-",explode(" ",$restaurant->name)))])}}" class="a-card-restaurant">
                <div class="card card-restaurant ">
                    @include('includes.image_restaurante')
                    <div class="card-body p-0 px-3 pt-2 ">

                        <div class="d-flex justify-content-between">
                            <p class="card-title my-0"><strong class="navbar-brand">{{$restaurant->name}}</strong></p>
                            <div class="badge badge-dark badge-restaurant mt-1" >
                                <strong>{{$restaurant->categoria}}</strong>
                            </div>
                        </div>
                        <p class="my-2 font-weight-light">
                            <img class="mb-1" src="https://img.icons8.com/ios/50/000000/place-marker.png" width="14"> {{$restaurant->distrito}} - {{$restaurant->address}}</p>
                    </div>
                </div>
                </a>
            </div>

        @endforeach
    </div>


</div>


@include('includes/footer')

<script type="text/javascript">
            var map = L.map('map');
            var marker=L.marker();
            var circle= L.circle();
            L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
              maxZoom: 25
            }).addTo(map);

            var mapContenedor=document.querySelector('#map');

            var btnShow=document.querySelector('#btnShow');
            var btnActual=document.querySelector('#btnActual');

            btnShow.addEventListener('click',function(){
                        mapContenedor.classList.toggle('show');
                        btnActual.classList.toggle('show');
                        localizar();



            });

            btnShow.click();
            function localizar(){
                if (navigator.geolocation) {
                     navigator.geolocation.getCurrentPosition(mostrarUbicacion);
                }
                const watcher = navigator.geolocation.watchPosition(mostrarUbicacion);
                setTimeout(() => {
                  navigator.geolocation.clearWatch(watcher);
              }, 10);
            }

            function mostrarUbicacion (ubicacion) {
               const lng = ubicacion.coords.longitude;
               const lat = ubicacion.coords.latitude;
               map.setView([lat,lng],14);
               map.removeLayer(circle);
               circle = L.circle([lat, lng], {
                   color: '#0064FF',
                   fillColor: '#0075CC',
                   fillOpacity: 0.5,
                   radius: 1000
               }).addTo(map);
               var cir = L.circle([lat, lng], {
                   color: 'red',
                   fillColor: 'red',
                   fillOpacity: 0.5,
                   radius: 1
               }).addTo(map);
               var popup = L.popup()
               .setLatLng([lat, lng])
               .setContent("<center><b>Hola!</b><br>Estas aquí</center>")
               .openOn(map);

            }

            @foreach ($restaurants as $restaurant)

                var n="{{$restaurant->name}}";
                var lat={{$restaurant->latitude}};
                var lon={{$restaurant->longitude}};
                var img='{{route('restaurant.image',["filename"=>$restaurant->image])}}';
                var ruta='{{ route("restaurant.detalle",["id"=>$restaurant->id,"nombre"=>strtolower(implode("-",explode(" ",$restaurant->name)))])}}';

                marker = L.marker([lat,lon]).addTo(map);
                marker.bindPopup("<a href='"+ruta+"'><img width='150px' src='"+img+"' alt='no image'/></a> <br /><b>"+n+"</b>").openPopup();

            @endforeach

            window.loaded=function(){

            }

</script>


@endsection
