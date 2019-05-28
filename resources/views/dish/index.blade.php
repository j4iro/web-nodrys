@extends('layouts.app')

@section('content')

@if (session('vacio'))
    <?php echo "<script>alert('".session('vacio')."');</script>" ?>
@endif

@section('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
       integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
       crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
      integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
      crossorigin=""></script>

      <script type="text/javascript" src={{asset('js/seleccion.js') }} rel="stylesheet"></script>

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
          .clasificación{
              direction:rtl;
              unicode-bidi:bidi-override:
          }
          #contCalif label:hover,label:hover~label{
              color:#02415F;
          }
          #contCalif input[type=radio]:checked~label{
              color:#02415F;
          }


      </style>

@endsection

<div class="container mt-5">

                @if ($sm!="")
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



            <strong class="navbar-brand pb-0">Puntuación</strong>
            {{-- <form id="formCali" name="formCali"> --}}
                <p id="contCalif" class="clasificación">
                    <input id="radio5" type="radio" name="tenedor" value="5" onclick="vaStart(this.id);">
                    <label class="start clasificación" for="radio5">&#9733;</label>
                    <input id="radio4" type="radio" name="tenedor" value="4" onclick="vaStart(this.id);">
                    <label class="start clasificación" for="radio4">&#9733;</label>
                    <input id="radio3" type="radio" name="tenedor" value="3" onclick="vaStart(this.id);">
                    <label class="start clasificación" for="radio3">&#9733;</label>
                    <input id="radio2" type="radio" name="tenedor" value="2" onclick="vaStart(this.id);">
                    <label class="start clasificación" for="radio2">&#9733;</label>
                    <input id="radio1" type="radio" name="tenedor" value="1" onclick="vaStart(this.id);">
                    <label class="start clasificación" for="radio1">&#9733;</label>
                </p>
            {{-- </form> --}}



            <form action="{{route('carrito.add')}}" method="post">

            <img class="mb-1" src="https://img.icons8.com/ios/50/000000/category-filled.png" width="16">
            {{$restaurant->categoria}}
            <br>
            <img class="mb-1" src="https://img.icons8.com/ios/50/000000/clock-filled.png" width="16">
            @if ($restaurant->availability==1)
                Abierto
            @else
                Cerrado
            @endif
            <form class="mt-3" action="{{route('carrito.add')}}" method="post">

                {{csrf_field()}}
                <input class="form-check-input d-none" type="checkbox" checked value="1" name="checkDish[]" >
                <input type="hidden" name="id_restaurant" value="{{$restaurant->id}}">
                <input type="hidden" name="solo_reserva" value="1">
                <input type="submit" class="btn btn-primary mt-2"  name="addcarrito" value="Solo reserva">
            </form>
        </div>
    </div>

    <form action="{{route('carrito.add')}}" method="post">
    {{csrf_field()}}

    <strong class="navbar-brand mt-3">¿Qué desea comer?</strong>
    <div class="row ">
        @foreach ($dishes as $dish)
            <div class="col-6 col-md-4 col-lg-2 mb-4">
                <label for="{{$dish->id}}">
                    <div class="card card-plato">
                        <img id="{{$dish->id}}i" src="{{ route('dish.image',['filename'=>$dish->image]) }}" class="card-img-top img-card-plato" alt="{{$dish->name}} en Nodrys">
                        <div id="{{$dish->id}}c" class="card-body p-0 px-3 pt-2 pb-3">
                            <h5 class="card-title card-title-plato mb-1">{{$dish->name}}</h5>
                            <p class="card-text card-text-plato m-0">{{$dish->time}} Min.</p>
                            <p class="card-text card-text-plato m-0">S/. {{$dish->price}}</p>
                            <input class="form-check-input" onclick="seleccionar(this.id);" type="checkbox" id="{{$dish->id}}" value="{{$dish->id}}" name="checkDish[]" >
                        </div>
                    </div>
                </label>
            </div>
        @endforeach
    </div>
    @if (count($dishes)!=0)
        <div class="row">
            <div class="col-3">
                <input type="hidden" name="id_restaurant" value="{{$restaurant->id}}">
                <input type="submit" class="btn btn-primary"  name="addcarrito" value="Añadir al carrito">
            </div>
        </div>
    @endif

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


        var marker=L.marker();

        var map = L.map('map');
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
