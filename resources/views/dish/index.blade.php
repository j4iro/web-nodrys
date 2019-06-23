@extends('layouts.app')

@if (session('vacio'))
    <?php echo "<script>alert('".session('vacio')."');</script>" ?>
@endif

@section('title')
    {{"Restaurante ". $restaurant->name . " en Nodrys"}}
@endsection

@section('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
       integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
       crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
      integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
      crossorigin=""></script>


    <style media="screen">
        #map{
            height: 400px;
        }
        .hubicacion_controls{
            display: none;
        }
        .btnActual{
            position: absolute;
            z-index: 99;
            right: 0;
        }
        .map_container{
          position: relative;
        }
        input[type=checkbox]{
            display: none;
        }

        input[type=radio]{
            display:none;
        }
        .start{
            cursor:pointer;
            font-size:200%;
            color:gray;
        }
        .clasificacion{
            direction:rtl;
            unicode-bidi:bidi-override;
            margin-top: -15px;
        }
        .btn-warning
        {
            margin-top: -15px;

        }
        #contCalif{
            pointer-events: none;
        }
        #contCalif ~label{
            color:#FFCC00;
        }
        #contCalif input[type=radio]:checked~label{
            event:none;
            color:#FFCC00;
        }

        #contCalif2 label:hover, #contCalif2 label:hover~label{
            color:#FFCC00;
        }
        #contCalif2 input[type=radio]:checked~label{
            color:#FFCC00;
        }

        .card-dias
        {
            width: 150px;
            cursor: pointer;
        }

        .cursor-pointer{
        cursor: pointer;
        }

        @media screen and (max-width: 320px)
        {
            .card-dias
            {
                width: 140px;
            }
        }


    </style>



      <script type="text/javascript" src={{asset('js/seleccion.js') }} rel="stylesheet"></script>
      <script type="text/javascript" src="{{asset('js/js/ajax.js')}}"></script>


      <script type="text/javascript">
          var id_user='<?php
              if(\Auth::user()!=null)
              {
                  echo \Auth::user()->id;
              }else{
                  echo 'no-log';
              }
          ?>';
          //obtenemos id usuarios
          var restaurant_id={{$restaurant->id}};//obtenemos id usuarios
          var divCalif=  document.getElementById('contCalif2');

          verCalifi();
          verCalifiR();

          //funcion para ver calificacion de mismo usuario
          function verCalifi(){
              if (id_user!='no-log') {
                  var obtnerMiCalf={!!json_encode(route('calificar.obtnerCali'))!!};
                  $.get(obtnerMiCalf,{
                      user_id:id_user,
                      restaurant_id:restaurant_id
                  },function(resultados){
                      if (resultados!="") {
                          var score=parseInt(resultados);
                          var check= document.getElementById('dar'+score);
                          check.checked=true;
                      }
                  });
              }
          }

          //funcion para ver puntaje del restaurante
          function verCalifiR(){
              var obtnerMiCalfR={!!json_encode(route('calificar.obtnerCaliR'))!!};
              $.get(obtnerMiCalfR,{
                  restaurant_id:restaurant_id
              },function(resultados){
                  if (resultados!='null') {
                      document.getElementById('lblpuntaje').innerText=resultados+'/5';
                      document.getElementById('rbd'+parseInt(resultados)).checked=true;
                  }
              });
          }

          //funcion para mostrar para valorar
          function aparecerVa(){
              if (id_user!='no-log') {
                  var validarP={!!json_encode(route('calificar.consultarPe'))!!};
                  $.get(validarP,{
                      user_id:id_user,
                      restaurant_id:restaurant_id
                  },function(resultados){
                      if (resultados=='true') {
                          var divCalif=  document.getElementById('contCalif2');
                          if (divCalif.style.opacity=='0') {
                              divCalif.style="opacity:1;transition:2s;float:left;";
                          }else{
                              divCalif.style="opacity:0;transition:2s;float:left;";
                          }
                      }else{
                          var mensaje=document.getElementById('mensaje');
                          mensaje.style="opacity:1;transition:1s";
                          var intervalo=setInterval(function () {
                            mensaje.style="opacity:0;transition:1s";
                        }, 9000);
                      }
                  });
              }else{
                  window.location='../login';
              }

          }

          //funcion para calificar
          function vaStart(id){
              if (id_user!='no-log') {
                  var valoracion=document.getElementById(id).value;
                  var DarCalif={!!json_encode(route('calificar.store'))!!};
                  $.get(DarCalif,{
                      user_id:id_user,
                      restaurant_id:restaurant_id,
                      score:valoracion
                  },function(resultados){
                      verCalifiR();
                      verCalifi();
                      var divCali=document.getElementById('contCalif2').style='opacity:0;transition:1s;float:left;';
                      if (resultados!='1') {
                          aparecerVa();

                          var mensaje=document.getElementById('mensaje');
                          mensaje.style="opacity:1;transition:1s";
                            var intervalo=setInterval(function () {
                                mensaje.style="opacity:0;transition:1s";
                            }, 9000);
                      }
                  });
              }else{
                  window.location='../login';
              }
            }


      </script>

@endsection



@section('content')

<div class="container mt-1">
    <div id="mensaje" class="alert alert-primary" role="alert" style="opacity:0">
        Aún no has experimentado de los servicios del restaurante para calificar. ¿Qué  esperas? ¡Haz tu reserva!
    </div>

    @if($sm!="")
        <strong>
            <div class="alert alert-danger">{{$sm}}</div>
        </strong>
    @endif

    <div class="row ">
        <div class="col-12 col-sm-6">
            <img class="img-thumbnail shadow" src="{{route('restaurant.image',["filename"=>$restaurant->image])}}" width="100%" >
        </div>
        <div class="col-12 col-sm-6">
            <strong class="navbar-brand">{{$restaurant->name}}</strong><br>
            {{$restaurant->slogan}}
            <br>
            {{$restaurant->description}}
            <br>
            <hr>
            <img class="mb-1" src="https://img.icons8.com/ios/50/000000/discount-filled.png" width="16">
            Gana <strong>{{$restaurant->points}}</strong> puntos por hacer tu reserva aquí
            <br>
            <img class="mb-1" src="https://img.icons8.com/ios-glyphs/30/000000/marker.png" width="16">
            {{$restaurant->address}} - <strong>{{$restaurant->distrito}}</strong>
            <br>
            <img class="mb-1" src="https://img.icons8.com/ios/50/000000/phone-not-being-used-filled.png" width="16">
            {{$restaurant->telephone}}
            <br>

            <div class="row">
                <div class="col-6 pb-0">
                    <img class="mb-1" src="https://img.icons8.com/ios/50/000000/category-filled.png" width="16">
                    {{$restaurant->categoria}}
                    <br>
                    <img class="mb-1" src="https://img.icons8.com/ios/50/000000/clock-filled.png" width="16">
                    @if ($restaurant->availability==1)
                        Abierto
                    @else
                        Cerrado
                    @endif
                </div>
                <div class="col-6 pb-0 d-flex justify-content-end">
                    <form  action="{{route('carrito.add')}}" method="post">
                        {{csrf_field()}}
                        <input class="form-check-input d-none" type="checkbox" checked value="{{$reserva->id}}" name="checkDish[]" >
                        <input type="hidden" name="id_restaurant" value="{{$restaurant->id}}">
                        <input type="hidden" name="solo_reserva" value="1">
                        <input type="submit" class="btn btn-primary mt-2 "  name="addcarrito" value="Reservar lugar">
                     </form>
                </div>
            </div>

            <hr class="mt-0">
            <div id="contCalif" class="clasificacion" >
                <strong class="mb-2" id="lblpuntaje">0/5</strong>
                <input id="rbd5" type="radio" name="valoracion">
                <label class="start clasificación" for="rbd5">&#9733;</label>
                <input id="rbd4" type="radio" name="valoracion">
                <label class="start clasificación" for="rbd4">&#9733;</label>
                <input id="rbd3" type="radio" name="valoracion">
                <label class="start clasificación" for="rbd3">&#9733;</label>
                <input id="rbd2" type="radio" name="valoracion" >
                <label class="start clasificación" for="rbd2">&#9733;</label>
                <input id="rbd1" type="radio" name="valoracion" >
                <label class="start clasificación" for="rbd1">&#9733;</label>
                <button id="DarCalificacion" class="btn btn-warning btn-sm" onclick="aparecerVa();">Danos tu calificación</button>
            </div>

            <p  style="height:auto;">

                <div  id="contCalif2" class="clasificacion"  style="opacity:0;float:left;">
                    <input id="dar5" type="radio" name="tenedor" value="5" onclick="vaStart(this.id);">
                    <label class="start clasificación" for="dar5">&#9733;</label>
                    <input id="dar4" type="radio" name="tenedor" value="4" onclick="vaStart(this.id);">
                    <label class="start clasificación" for="dar4">&#9733;</label>
                    <input id="dar3" type="radio" name="tenedor" value="3" onclick="vaStart(this.id);">
                    <label class="start clasificación" for="dar3">&#9733;</label>
                    <input id="dar2" type="radio" name="tenedor" value="2" onclick="vaStart(this.id);">
                    <label class="start clasificación" for="dar2">&#9733;</label>
                    <input id="dar1" type="radio" name="tenedor" value="1" onclick="vaStart(this.id);">
                    <label class="start clasificación" for="dar1">&#9733;</label>
                </div>
        </div>
    </div>





    <div class="row d-flex justify-content-between flex-wrap px-2" >

            <button class="btn btn-light border border-dark card-dias" id="lunes" onclick="mostrardia(this.id,{{$restaurant->id}})">
                Lunes
            </button>

            <button class="btn btn-light border border-dark card-dias" id="martes" onclick="mostrardia(this.id,{{$restaurant->id}})">
                Martes
            </button>

            <button class="btn btn-light border border-dark card-dias" id="miércoles" onclick="mostrardia(this.id,{{$restaurant->id}})">
                Miercoles
            </button>

            <button class="btn btn-light border border-dark card-dias" id="jueves" onclick="mostrardia(this.id,{{$restaurant->id}})">
                Jueves
            </button>

            <button class="btn btn-light border border-dark card-dias" id="viernes" onclick="mostrardia(this.id,{{$restaurant->id}})">
                Viernes
            </button>

            <button class="btn btn-light border border-dark card-dias" id="sábado" onclick="mostrardia(this.id,{{$restaurant->id}})">
                Sabado
            </button>

            <button class="btn btn-light border border-dark card-dias" id="domingo" onclick="mostrardia(this.id,{{$restaurant->id}})">
                Domingo
            </button>

    </div>
    <script>
        mostrardia('{{$dias[date('w')]}}','{{$restaurant->id}}');
    </script>
<form action="{{route('carrito.add')}}" method="post">
{{csrf_field()}}

<div class="row  bg-white mt-3 shadow-sm border border-ligth rounded">
    <div class="col-12 my-2">
            @if(count($dishes)==0)
            <center>
                <strong class="navbar-brand">El Restaurante aún no ha registrado platos, pero puedes RESERVAR el lugar </strong>
            </center>
        @else
            <center>
                <strong class="navbar-brand">¿Qué desea comer?</strong>
            </center>
        @endif
    </div>

    <div class="col-12">
        <div class="row" id="rpta_platos">

        </div>
    </div>

    <div class="col-12 mb-3">
        @if (count($dishes)!=0)
            <input type="hidden" name="id_restaurant" value="{{$restaurant->id}}">
            <input type="submit" class="btn btn-primary btn-block"  name="addcarrito" value="Añadir al carrito">
        @endif
    </div>
</div>



    <div class="row">
        <div class="col-3">
            <input type="hidden" name="id_restaurant" value="{{$restaurant->id}}">
        </div>
    </div>

    </form>

    <strong class="navbar-brand mt-3">Encuentranos en</strong>
    {{-- mapa --}}
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
    @include('includes/footer')

@endsection




<script>


var marker=L.marker();
var map = L.map('map');
map.scrollWheelZoom.disable();
L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
    maxZoom: 18
}).addTo(map);


function localizar(){
const watcher = navigator.geolocation.watchPosition(mostrarUbicacion);
setTimeout(() => {
    navigator.geolocation.clearWatch(watcher);
}, 10);
}


if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(mostrarUbicacion);
}

const watcher = navigator.geolocation.watchPosition(mostrarUbicacion);

setTimeout(() => {
navigator.geolocation.clearWatch(watcher);
}, 10);



function mostrarUbicacion (ubicacion) {
const lng = ubicacion.coords.longitude;
const lat = ubicacion.coords.latitude;

map.setView([{{$restaurant->latitude}},{{$restaurant->longitude}}],14);
var circle = L.circle([lat, lng], {
    color: '#0064FF',
    fillColor: '#0075CC',
    fillOpacity: 0.5,
    radius: 50
}).addTo(map);
var circle = L.circle([lat, lng], {
    color: 'red',
    fillColor: 'red',
    fillOpacity: 0.5,
    radius: 1
}).addTo(map);

circle.bindPopup("<b>Hola!</b><br>Estas aquí").openPopup();

var nomR='{{$restaurant->name}}';
var latR={{$restaurant->latitude}};
var lonR={{$restaurant->longitude}};
marker = L.marker([latR, lonR]).addTo(map);
marker.bindPopup("<b>"+nomR+"</b>").openPopup();
}


</script>
