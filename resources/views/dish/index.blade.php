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

      <script type="text/javascript" src={{asset('js/seleccion.js') }} rel="stylesheet"></script>
      <script type="text/javascript" src="{{asset('js/js/ajax.js')}}"></script>


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
        .clasificacion2{
            direction:rtl;
            unicode-bidi:bidi-override;
            margin-top: -10px;
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

        .btn-dias
        {
            width: 145px;
        }

        @media screen and (max-width: 320px)
        {
            .btn-dias
            {
                width: 135px;
            }
        }

        .container-estrellas
        {
            margin-top: -50px;
            width: 530px;
            /* border-radius: 0 0 7px 7px; */
            height: 45px;
            margin-left: 20px;
            z-index: 100;
            opacity: 0.9;
            background-color: rgba(0, 0, 0, 0.5);
        }

    </style>



@endsection



@section('content')

<div class="container mt-1">




    @if($sm!="")
        <strong>
            <div class="alert alert-danger mt-3">{{$sm}}</div>
        </strong>
    @endif

    @guest
        <input type="hidden" name="" id="iduser" value="no log">
    @else
        <input type="hidden" name="" algo="hola" id="iduser" value="{{\Auth::user()->id}}">
    @endguest

    <div class="row ">
        <div class="col-12 col-sm-6">
            <div class="row">
            <div class="col-12">
                <img class="img-thumbnail shadow" src="{{route('restaurant.image',["filename"=>$restaurant->image])}}" width="100%" >
            </div>
            <div id="contCalif" class="bg-dark container-estrellas clasificacion pl-3">
                {{-- <div  class="" > --}}
                    {{-- <strong class="mb-2" id="lblpuntaje">0/5</strong> --}}
                    <input id="rbd5" type="radio" name="valoracion">
                    <label class="start clasificación" for="rbd5">&#9733;</label>
                    <input id="rbd4" type="radio" name="valoracion">
                    <label class="start clasificación" for="rbd4">&#9733;</label>
                    <input id="rbd3" type="radio" name="valoracion">
                    <label class="start clasificación"  for="rbd3">&#9733;</label>
                    <input id="rbd2" type="radio"  name="valoracion" >
                    <label class="start clasificación" for="rbd2">&#9733;</label>
                    <input id="rbd1" type="radio" name="valoracion" >
                    <label class="start clasificación" for="rbd1">&#9733;</label>
                {{-- </div> --}}
            </div>
            </div>
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

            <hr >
            <div class="row">
                <div class="col-3">
                    <button class="btn btn-warning btn-sm" onclick="aparecerVa();">Danos tu calificación</button>
                </div>
                <div class="col-4">
                    <div  id="contCalif2" class="clasificacion2"  >
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
                <div class="col-5 p-0">
                    <div id="mensaje" class="alert alert-primary py-1 d-none" role="alert">
                           <strong>Necesitas hacer una reserva</strong>
                    </div>
                </div>
             </div>
        </div>
    </div>





    <div class="row d-flex justify-content-between flex-wrap px-3 mt-5" >
        <button class="btn btn-light border border-dark btn-dias" id="lunes" onclick="mostrardia(this.id,{{$restaurant->id}})">
            Lunes
        </button>

        <button class="btn btn-light border border-dark btn-dias" id="martes" onclick="mostrardia(this.id,{{$restaurant->id}})">
            Martes
        </button>

        <button class="btn btn-light border border-dark btn-dias" id="miércoles" onclick="mostrardia(this.id,{{$restaurant->id}})">
            Miercoles
        </button>

        <button class="btn btn-light border border-dark btn-dias" id="jueves" onclick="mostrardia(this.id,{{$restaurant->id}})">
            Jueves
        </button>

        <button class="btn btn-light border border-dark btn-dias" id="viernes" onclick="mostrardia(this.id,{{$restaurant->id}})">
            Viernes
        </button>

        <button class="btn btn-light border border-dark btn-dias" id="sábado" onclick="mostrardia(this.id,{{$restaurant->id}})">
            Sabado
        </button>

        <button class="btn btn-light border border-dark btn-dias" id="domingo" onclick="mostrardia(this.id,{{$restaurant->id}})">
            Domingo
        </button>

    </div>



<form action="{{route('carrito.add')}}" method="post">
{{csrf_field()}}

<div class="row  bg-white mt-3 mx-0 shadow-sm border border-ligth rounded">


    <div class="col-12">
        <div class="row" id="rpta_platos">

        </div>
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

    <script>
            mostrardia('{{$dias[date('w')]}}','{{$restaurant->id}}');
        </script>

    <script type="text/javascript">


        var id_user=document.getElementById('iduser').value;

        if(id_user=='no log'){
            id_user='no-log';
        }

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
                    document.getElementById('rbd'+parseInt(resultados)).checked=true;
                }else{
                    document.getElementById('rbd5').checked=true;
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
                    if (resultados!='1') {
                        aparecerVa();

                        var mensaje=document.getElementById('mensaje');
                        if(mensaje.classList.contains('d-none')){
                            mensaje.classList.remove('d-none');
                        }
                        mensaje.style="opacity:1;transition:1s";
                        setTimeout ("if(!mensaje.classList.contains('d-none')){mensaje.classList.add('d-none');}", 5000);

                    }
                });
            }else{
                window.location='../login';
            }
          }


    </script>
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



@endsection
