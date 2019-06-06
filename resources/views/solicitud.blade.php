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
      </style>
@endsection
@section('title')
    Solicitud de registro
@endsection
@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(session('resultado'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{session('resultado')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    <strong>¡Excelente Decisión!</strong> Para formar parte de la plataforma por favor complete el siguiente formulario, una vez la solicitud se envie, nos pondremos en contacto con usted por medio de <strong>E-mail</strong> o <strong>teléfono</strong> para responderle su solicitud. Esto puede demorar <strong>24 horas</strong> aproximadamente. Gracias por su elección.
                </div>
            @endif



            <div class="card shadow">
                <div class="card-header">Solicitud</div>

                <div class="card-body">
                <form method="POST" action="{{ route('solicitud.save') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="Nombre del restaurante" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="slogan" class="col-md-4 col-form-label text-md-right">{{ __('Slogan') }}</label>

                            <div class="col-md-6">
                                <input id="slogan" type="text" placeholder="Slogan del restaurante" class="form-control{{ $errors->has('slogan') ? ' is-invalid' : '' }}" name="slogan" required >

                                @if ($errors->has('slogan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('slogan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" placeholder="Describa su restaurante" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" required rows="3" ></textarea>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group container">
                                <div class="hubicacion_controls">
                                  Latitud : <input type="text" name="txtlati" id="txtlati">
                                  longitud : <input type="text" name="txtlong" id="txtlong">
                                </div>

                                <div class="map_container">
                                    <div id="map">

                                    </div>
                                    <button id="btnActual" class="btn btn-primary btn-actual p-1 " type="button" class="btnActual" name="button" onclick="localizar()">
                                            <img src="{{asset('images/icons/actualizacion-de-ubicacion.png')}}" width="25" height="inherid">
                                    </button>
                                </div>

                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Dirección') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" placeholder="Ejemplo: Jr Enrique Barrón 1038 - Santa Beatriz" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" required >

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="Email para contactarlo" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required >

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telephone" class="col-md-4 col-form-label text-md-right">teléfono - Celular</label>

                            <div class="col-md-6">
                                <input id="telephone" maxlength="9" min="8" placeholder="Telefono o Celular" type="text" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" required>

                                @if ($errors->has('telephone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telephone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="points" class="col-md-4 col-form-label text-md-right">Puntos</label>

                            <div class="col-md-6">
                                <input id="points" type="number" placeholder="Cantidad de puntos por reserva" class="form-control{{ $errors->has('points') ? ' is-invalid' : '' }}" name="points" >

                                @if ($errors->has('points'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('points') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="district_id_name" class="col-md-4 col-form-label text-md-right">Distrito</label>

                            <div class="col-md-6">

                                <select class="form-control" name="district_id_name" id="type" required>

                                    @foreach ($distritos as $distrito)
                                        <option value="{{$distrito->id}}" @if(isset($restaurante->district_id) && $distrito->id==$restaurante->district_id) {{'selected'}} @endif >{{$distrito->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('district_id_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('district_id_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category_id_name" class="col-md-4 col-form-label text-md-right">Categoría</label>

                            <div class="col-md-6">

                                    <select class="form-control" name="category_id_name" id="type" required>
                                        @foreach ($categorias as $categoria)
                                            <option value="{{$categoria->id}}" @if(isset($restaurante->category_id) && $categoria->id==$restaurante->category_id) {{'selected'}} @endif>{{$categoria->name}}</option>
                                        @endforeach
                                    </select>

                                @if ($errors->has('category_id_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category_id_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Foto</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control-file {{ $errors->has('image') ? ' is-invalid' : '' }}" name="image"  required >

                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="ruc" class="col-md-4 col-form-label text-md-right" >RUC</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="ruc" placeholder="RUC" required >
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Enviar solicitud
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes/footer')

<script>

    var txtLati=document.getElementById('txtlati');
    var txtLong=document.getElementById('txtlong');
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
    txtLati.value=lat;
    txtLong.value=lng;
    console.log(`longitud: ${ lng } | latitud: ${ lat }`);

    map.setView([lat,lng],14);
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
    var popup = L.popup()
    .setLatLng([lat, lng])
    .setContent("<b>Hola!</b><br>Estas aquí")
    .openOn(map);
    map.removeLayer(marker);
    marker = L.marker([lat, lng], {draggable: true}).addTo(map);
    marker.on('drag', onMapClick);
    }

function onMapClic(e) {
    var valor=e.latlng.toString().replace(/ /g, "");
    var n1=valor.indexOf("(")+1;
    var nExtraer=(valor.indexOf(")"))-n1;
    var coordenadas=valor.substr(n1,nExtraer).split(",")
    txtLati.value=coordenadas[0];
    txtLong.value=coordenadas[1];
    console.log(coordenadas);

    map.removeLayer(marker);
    marker = L.marker([coordenadas[0],coordenadas[1]], {draggable: true}).addTo(map);
    marker.bindPopup("<b>Hola!</b><br>Esta es mi ubicación.").openPopup();
    marker.on('drag', onMapClick);

}
map.on('click', onMapClic);

function onMapClick(e) {
    var popup = L.popup();
    var valor=e.latlng.toString().replace(/ /g, "");
    var n1=valor.indexOf("(")+1;
    var nExtraer=(valor.indexOf(")"))-n1;
    var coordenadas=valor.substr(n1,nExtraer).split(",")
    popup
        .setLatLng(e.latlng)
        .setContent("" + valor)
        .openOn(map);
        console.log(coordenadas);
    txtLati.value=coordenadas[0];
    txtLong.value=coordenadas[1];
}

</script>
@endsection
