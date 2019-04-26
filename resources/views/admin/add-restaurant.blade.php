@extends('layouts.app-a')

@section('content')

<div class="container-fluid mt-3">
    <form action="{{route('admin.restaurant.save')}}" method="post" enctype="multipart/form-data">

    <!--Formulario de Registro-->
    <div class="row ">

    @include('includes/slidebar-admin')

    <div class="col-12 col-md-9  col-lg-7 mb-3">

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
                    <label for="name">Descripción</label>
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
                    <input type="text" class="form-control" name="telephone"  placeholder="Telefono o celular" id="telephone" value="{{ $restaurante->telephone ?? '' }}" required  >
                </div>
                <div class="form-group col-12  col-md-6 ">
                    <label for="type"><strong>Email de ingreso</strong></label>
                    <input type="email" class="form-control" name="email_ingreso" value="{{ $user->email ?? '' }}" placeholder="Email de acceso al panel" id="address" required>
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-12  col-md-6 ">
                    <label for="password"><strong>Contraseña</strong></label>
                    <input type="text" class="form-control" name="password" placeholder="Nueva contraseña" id="password"  @if(isset($restaurante) && !isset($solicitud)) {{''}} @else {{'required'}} @endif >

                </div>
                <div class="form-group col-12  col-md-6 ">
                    <label for="repeatpassword"><strong>Repita la Contraseña</strong></label>
                    <input type="text" class="form-control @if (session('error_password')) {{'is-invalid'}} @endif" name="repeatpassword"  placeholder="Repita la contraseña" id="repeatpassword" @if(isset($restaurante) && !isset($solicitud)) {{''}} @else {{'required'}} @endif >
                    <div class="invalid-feedback" >
                        <strong>Las contraseñas no coinciden</strong>
                    </div>
                </div>
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
    </div>
</div>
<!--Formulario de Registro-->

</div>

</form>

@endsection
