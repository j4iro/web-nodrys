@extends('layouts.app-a')
@section('scripts')
      <script type="text/javascript" src={{asset('js/validaciones.js') }} rel="stylesheet"></script>
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
                    <input type="text" class="form-control" name="slogan" value="{{ $restaurante->slogan ?? '' }}" placeholder="Frase breve y expresiva" id="slogan" required>
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
                    <label for="district_id">Distrito</label>
                    <select class="form-control" name="district_id" id="district_id">
                        @foreach ($distritos as $distrito)
                            <option value="{{$distrito->id}}" @if(isset($restaurante->district_id) && $distrito->id==$restaurante->district_id) {{'selected'}} @endif >{{$distrito->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-12  col-md-6 ">
                    <label for="category_id">Categoria</label>
                    <select class="form-control" name="category_id" id="category_id">
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
                    <input type="text" onkeypress="return validarNumero(event);" class="form-control" maxlength="11" name="ruc" value="{{ $restaurante->ruc ?? '' }}" placeholder="RUC" id="ruc" required>
                </div>

            </div>
            <div class="form-row">
                <div class="form-group col-12  col-md-6 ">
                    <label for="email_ingreso"><strong>Email de ingreso</strong></label>
                    <input type="email" class="form-control" name="email_ingreso" value="{{ $user->email ?? '' }}" placeholder="Email de acceso al panel" id="email_ingreso" required>
                </div>
                <div class="form-group col-12  col-md-6 ">
                    <label for="capacity"><strong>Aforo</strong></label>
                    <input type="number" class="form-control" name="capacity" value="" placeholder="Capacidad" id="capacity" required>
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
                    <input type="text" class="form-control" name="latitud" value="{{ $restaurante->latitude?? '' }}" placeholder="Latitud" id="latitud" required>
                </div>
                <div class="form-group col-12  col-md-6 ">
                    <label for="longitud">Longitud</label>
                    <input type="text" class="form-control" name="longitud" value="{{ $restaurante->longitude ?? '' }}" placeholder="Longitud" id="longitud" required>
                </div>
            </div>

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
                            <input type="hidden" class="form-control-file" name="imagen_soli" id="image_soli"  value="{{$restaurante->image}}" >
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


@endsection
