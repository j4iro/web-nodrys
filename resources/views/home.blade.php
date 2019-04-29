@extends('layouts.app')
@section('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
       integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
       crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
      integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
      crossorigin=""></script>

      <style media="screen">
          #map{
              /* width: 100%; */
              height: 400px;
          }
          .btnActual{
              position: absolute;
              z-index: 99;
              right: 0;
          }
          /* .map_container{
            position: relative;
          } */
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
                <button id="btnShow" type="button" class="btn btn-dark">
                    Ver cercanos
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

    <div id="contenedor_mapa" class="container p-0 shadow">

        <div class="d-none">
            Latitud : <input type="text" name="txtlati" id="txtlati">
            Longitud : <input type="text" name="txtlong" id="txtlong">
        </div>

        <div class="map_container">
            <div id="map"">
            </div>
        </div>

    </div>

    <button class="btn btn-primary btn-actual" type="button" class="btnActual" name="button" onclick="localizar()">Regresar</button>

    <div class="row mb-4 mt-2">
            {{csrf_field()}}
        <div class="col-6 col-lg-3 pt-2">
            <select name="categoria" class="form-control" id="">
                <option value="" disabled selected >Categorias</option>
                @foreach ($categorias as $categoria)
                    <option value="{{$categoria->id}}"   >{{$categoria->name}}</option>
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
                <a href="{{ route('restaurant.detalle',["id"=>$restaurant->id,"nombre"=>strtolower(implode("-",explode(" ",$restaurant->name)))])}}" style="text-decoration:none;">
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

<button type="button" onclick="notificar()">Enviar una notificaicon</button>
@include('includes/footer')
<script>
            var map = L.map('map');
            L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
              attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
              maxZoom: 25
            }).addTo(map);


             @foreach ($restaurants as $restaurant)

                 var n="{{$restaurant->name}}";
                 var lat={{$restaurant->latitude}};
                 var lon={{$restaurant->longitude}};
                 var img='{{route('restaurant.image',["filename"=>$restaurant->image])}}';

                 map.setView([lat,lon],14);
                 var marker = L.marker([lat,lon]).addTo(map);
                 marker.bindPopup("<img width='70px' src='"+img+"' alt='no image' /> <br /><b>"+n+"</b>").openPopup();

             @endforeach

      //$sql="SELECT restaurante, latitud, longitud, ( 6371 * acos(cos(radians(-12.0797741)) *
      // cos(radians(latitud)) * cos(radians(longitud) - radians(-77.0276488)) + sin(radians(-12.0797741)) *
      // sin(radians(latitud)))) AS distance FROM marcadores HAVING distance < 1 ORDER BY distance;";
      //
var btnShow=document.querySelector('#btnShow');
btnShow.addEventListener('click',function(){
 var mapContenedor=document.querySelector('#contenedor_mapa');
 mapContenedor.style.display="block";
});


document.addEventListener("DOMContentLoaded",function() {
    if (!Notification) {
        alert("Las notificaciones no estan soportadas en tu navegador")
        return
    }
    if(Notification.permission!=="granted")
        Notification.requestPermission()
});

function notificar() {
    if (Notification.permission!=="granted") {
        Notification.requestPermission();
    }else {
        var notificacion=new Notification("titulo de mi notificacion",{
            icon:"img.jpg",
            body:"Este es el contenido de la notificacion"
        });
        notificacion.onclick=function(){
            window.open("/");
        }
    }
}

</script>

@endsection
