@extends('layouts.app-a')

@section('content') 

<div class="container mt-3">
    <form action="{{route('admin.restaurant.save')}}" method="post" enctype="multipart/form-data">

    <!--Formulario de Registro-->
    <div class="row ">
         
    @include('includes/slidebar-admin')

    <div class="col-12 col-md-10 col-lg-8 ">

    <div class="card shadow p-4 bg-light">

        <div class="row">
            <dt class="col-12">
                @if (isset($restaurante))
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
            </div>
        </div>

            {{csrf_field()}}

            <div class="form-row ">
                <div class="form-group col-12  col-md-6 ">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" value="{{ $restaurante->name ?? '' }}" placeholder="Nombre" id="name" required>
                    
                </div>
                <div class="form-group col-12  col-md-6 ">
                    <label for="slogan">Eslogan</label>
                    <input type="text" class="form-control" name="slogan" value="{{ $restaurante->slogan ?? '' }}" placeholder="Breve Descripción" id="slogan" required>
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
                <div class="form-group col-12 col-md-6 ">
                    <label for="image">Imagen</label>
                    <input type="file" class="form-control-file" name="image" id="image"  @if (!isset($restaurante)) {{'required'}} @endif >
                </div>
                <div class="form-group col-12 col-md-6 pt-4">
                    <input type="submit" class="btn btn-primary btn-block" name="btnAgregar" value="@if(isset($restaurante)){{'Editar'}}@else{{'Agregar'}}@endif">
                </div>
            </div>

            <div class="form-row ">
                @if (isset($restaurante))
                    <div class="form-group col-12 col-md-6">
                        <img src="{{ route('restaurant.image',['filename'=>$restaurante->image]) }}" class="img-thumbnail shadow" width="150">
                    </div>
                @endif
                
            </div>

        </div>
    </div>
</div>
<!--Formulario de Registro-->

</div>

</form>
@endsection