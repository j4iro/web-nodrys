@extends('layouts.app-a')
@section('scripts')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.4.0/dist/leaflet.css"
       integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
       crossorigin=""/>
     <script src="https://unpkg.com/leaflet@1.4.0/dist/leaflet.js"
      integrity="sha512-QVftwZFqvtRNi0ZyCtsznlKSWOStnDORoefr1enyq5mVL4tmKB3S/EnC3rRJcxCPavG10IcrVGSmPh6Qw5lwrg=="
      crossorigin=""></script>
      <script type="text/javascript" src={{asset('js/validaciones.js') }} rel="stylesheet"></script>
      <style media="screen">
          #map{
              width: 80%;
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
@section('content')
    <form action="{{route('admin.restaurant.save')}}" method="post" enctype="multipart/form-data">
    <div class="card shadow p-4 ">

        <div class="row">
            <dt class="col-12">
                @if (isset($restaurante) && !isset($solicitud))
                    Editar Restaurante

                    <input type="hidden" name="editar" value="editar">
                    <input type="hidden" name="id" value="{{ $restaurante->id ?? '' }}">
                @else
                    Nuevo Restaurante
                    <input type="hidden" name="editar" value="agregar">
                    @if (isset($solicitud))
                    <input type="hidden" name="solicitud" value="{{$solicitud}}" >
                    @endif
                @endif
                <hr>
            </dt>
        </div>
        <div class="row">
            <div class="col-12">
                @if (session('resultado'))
                    <strong>
                        <div class="alert alert-success">{{session('resultado')}}</div>
                    </strong>
                @endif
                @if (session('error_password'))
                    <strong>
                        <div class="alert alert-danger">{{session('error_password')}}</div>
                    </strong>
                @endif
            </div>
        </div>

            {{csrf_field()}}

            <div class="form-row ">
                <div class="form-group col-12 col-md-6 ">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" value="{{ $restaurante->name ?? '' }}" placeholder="Nombre" id="name" required>

                </div>
                <div class="form-group col-12 col-md-6 ">
                    <label for="slogan">Eslogan</label>
                    <input type="text" class="form-control" name="slogan" value="{{ $restaurante->slogan ?? '' }}" placeholder="Breve Descripción" id="slogan" required>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-12">
                    <label for="description">Descripción</label>
                    <textarea type="text" rows="3" class="form-control" name="description"  id="description" required>{{ $restaurante->description ?? '' }}</textarea>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-12  col-md-6 ">
                    <label for="address">Dirección</label>
                    <input type="text" class="form-control" name="address" value="{{ $restaurante->address ?? '' }}" placeholder="Dirección" id="address" required>
                </div>
                <div class="form-group col-12  col-md-6 ">
                    <label for="points">Puntos</label>
                    <input type="number" class="form-control" name="points" value="{{ $restaurante->points ?? '' }}" placeholder="Puntos por reservar" id="points" required>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-12  col-md-6 ">
                    <label for="type">Distrito</label>
                    <select class="form-control" name="district_id" id="type">
                        @foreach ($distritos as $distrito)
                            <option value="{{$distrito->id}}" @if(isset($restaurante->district_id) && $distrito->id==$restaurante->district_id) {{'selected'}} @endif >{{$distrito->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-12  col-md-6 ">
                    <label for="type">Categoria</label>
                    <select class="form-control" name="category_id" id="type">
                        @foreach ($categorias as $categoria)
                            <option value="{{$categoria->id}}" @if(isset($restaurante->category_id) && $categoria->id==$restaurante->category_id) {{'selected'}} @endif>{{$categoria->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-12  col-md-6 ">
                    <label for="telephone">Telefono - Celular</label>
                    <input type="text" onkeypress="return validarNumero(event);" class="form-control" name="telephone"  placeholder="Telefono o celular" id="telephone" value="{{ $restaurante->telephone ?? '' }}" required  >
                </div>
                <div class="form-group col-12  col-md-6 ">
                    <label for="ruc">RUC</label>
                    <input type="text" onkeypress="return validarNumero(event);" class="form-control" name="ruc" value="{{ $restaurante->ruc ?? '' }}" placeholder="RUC" id="ruc" required>
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-12  col-md-6 ">
                    <label for="type"><strong>Email de ingreso</strong></label>
                    <input type="email" class="form-control" name="email_ingreso" value="{{ $user->email ?? '' }}" placeholder="Email de acceso al panel" id="address" required>
                </div>
                <div class="form-group col-12  col-md-6 ">
                    <label for="type"><strong>Aforo</strong></label>
                    <input type="number" class="form-control" name="capacity" value="{{ $restaurante->capacity ?? '0' }}" placeholder="capadidad" id="capacity" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-12  col-md-6 ">
                    <label for="password"><strong>Contraseña</strong></label>
                    <input type="password" class="form-control" name="password" placeholder="Nueva contraseña" id="password"  @if(isset($restaurante) && !isset($solicitud)) {{''}} @else {{'required'}} @endif >

                </div>
                <div class="form-group col-12  col-md-6 ">
                    <label for="repeatpassword"><strong>Repita la Contraseña</strong></label>
                    <input type="password" class="form-control @if (session('error_password')) {{'is-invalid'}} @endif" name="repeatpassword"  placeholder="Repita la contraseña" id="repeatpassword" @if(isset($restaurante) && !isset($solicitud)) {{''}} @else {{'required'}} @endif >
                    <div class="invalid-feedback" >
                        <strong>Las contraseñas no coinciden</strong>
                    </div>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-12  col-md-6 ">
                    <label for="latitud">Latitud</label>
                    <input type="number" class="form-control" name="latitud" value="{{ $restaurante->latitude?? '' }}" placeholder="Latitud" id="latitud" required>
                </div>
                <div class="form-group col-12  col-md-6 ">
                    <label for="longitud">Longitud</label>
                    <input type="number" class="form-control" name="longitud" value="{{ $restaurante->longitude ?? '' }}" placeholder="Longitud" id="longitud" required>
                </div>
            </div>
            <div class="form-group container">
                    <div class="hubicacion_controls">
                      Latitud : <input type="text" name="txtlati" id="txtlati">
                      longitud : <input type="text" name="txtlong" id="txtlong">
                    </div>

                    <center>
                        <div class="map_container">
                            <div id="map">

                            </div>
                            <button class="btn btn-primary" type="button" class="btnActual" name="button" onclick="localizar()">Ubicacion Actual</button>
                        </div>

                    </center>
            </div>



            <hr>

            <div class="form-row d-flex justify-content-center ">
                <div class="form-group col-12 col-md-5 text-center shadow-sm border  p-2 rounded">
                    <label for="image"><strong>Imagen</strong></label>
                    <input type="file" class="form-control-file" name="image" id="image"  @if (!isset($restaurante)) {{'required'}} @endif >
                </div>
            </div>

            <div class="form-row d-flex justify-content-center">
                @if (isset($restaurante))
                    <div class="form-group col-12 col-md-5">
                        <img src="{{ route('restaurant.image',['filename'=>$restaurante->image]) }}" class="img-thumbnail shadow" width="100%">
                        @if (isset($solicitud))
                            <input type="hidden" class="form-control-file" name="imagen_soli" id="image"  value="{{$restaurante->image}}" >
                        @endif
                    </div>
                @endif
            </div>

            <div class="form-row d-flex justify-content-center">
                <div class="form-group col-12 col-md-5">
                    <input type="submit" class="btn btn-primary btn-block" id="guardar" name="btnAgregar" value="Guardar">
                </div>
            </div>



        </div>

</form>

<script>

            var txtnombre=document.getElementById('name').value;
            var txtLati=document.getElementById('latitud');
            var txtLong=document.getElementById('longitud');

            var lati=parseFloat(txtLati.value);
            var long=parseFloat(txtLong.value);

            var marker=L.marker();

            var map = L.map('map');
             L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                 attribution: 'Map data &copy; <a href="http://openstreetmap.org">OpenStreetMap</a> contributors, <a href="http://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="http://cloudmade.com">CloudMade</a>',
                 maxZoom: 18
             }).addTo(map);


             ubicaionRes();

             function ubicaionRes(){
                 map.setView([lati,long],15);
                 map.removeLayer(marker);
                 marker = L.marker([lati,long], {draggable: true}).addTo(map);
                  marker.on('drag', onMapClic);
             }

            function onMapClic(e) {
                console.log(e);
                    txtLati.value=e.latlng.lat;
                    txtLong.value=e.latlng.lng;
            }



         </script>

@endsection
