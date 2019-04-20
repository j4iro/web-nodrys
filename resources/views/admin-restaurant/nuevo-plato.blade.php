@extends('layouts.app-r')

@section('content') 

<div class="container-fluid mt-3">
    <form action="{{route('adminRestaurant.plato.save')}}" method="post" enctype="multipart/form-data">

    <!--Formulario de Registro-->
    <div class="row ">
         
    @include('includes/slidebar')

    <div class="col-12 col-md-10 col-lg-8 ">

       

    <div class="card shadow p-4 bg-light">

        <div class="row">
            <dt class="col-12">
                @if (isset($plato))
                    Editar Plato
                    <input type="hidden" name="editar" value="editar">
                    <input type="hidden" name="id" value="{{ $plato->id ?? '' }}">
                @else
                    Nuevo plato
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
                    <input type="text" class="form-control" name="name" value="{{ $plato->name ?? '' }}" placeholder="Nombre" id="name" required>
                    
                </div>
                <div class="form-group col-12  col-md-6 ">
                    <label for="description">Descripción</label>
                    <input type="text" class="form-control" name="description" value="{{ $plato->description ?? '' }}" placeholder="Descripción" id="description" required>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-12  col-md-6 ">
                    <label for="price">Precio</label>
                    <input type="number" class="form-control" name="price" value="{{ $plato->price ?? '' }}" placeholder="Precio" id="price" required>
                </div>
                <div class="form-group col-12  col-md-6 ">
                    <label for="time">Tiempo</label>
                    <input type="number" class="form-control" name="time" value="{{ $plato->time ?? '' }}" placeholder="Minutos en prepararlo" id="time" required>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-12  col-md-6 ">
                    <label for="image">Imagen</label>
                    <input type="file" class="form-control-file" name="image" id="image"  @if (!isset($plato)) {{'required'}} @endif >
                </div>
                <div class="form-group col-12  col-md-6 ">
                    <label for="type">Tipo</label>
                    <select class="form-control" name="type" id="type">
                        
                        @if (isset($plato))
                            <option value="segundo" @if($plato->type=='segundo'){{'selected'}} @endif >Segundo</option>
                            <option value="entrada" @if($plato->type=='entrada'){{'selected'}} @endif >Entrada</option>
                            <option value="bebida" @if($plato->type=='bebida'){{'selected'}} @endif >Bebida</option>
                        @else
                            <option value="segundo" >Segundo</option>
                            <option value="entrada" >Entrada</option>
                            <option value="bebida" >Bebida</option>
                        @endif
                        

                    </select>
                </div>
            </div>

            <div class="form-row ">
                <div class="form-group col-12  col-md-6">
                    <input type="hidden" class="form-control" name="restaurant_id" value="1" id="">
                </div>
            </div>

            <div class="form-row ">
                @if (isset($plato))
                    <div class="form-group col-12 col-md-6">
                        <img src="{{ route('dish.image',['filename'=>$plato->image]) }}" class="img-thumbnail shadow" width="70">
                    </div>
                @endif
                <div class="form-group col-12  col-md-6">
                <input type="submit" class="btn btn-primary btn-block" name="btnAgregar" value="@if(isset($plato)){{'Editar'}}@else{{'Agregar'}}@endif">
                    </div>
                </div>
            </div>

           

            
        </div>
    </div>
</div>
<!--Formulario de Registro-->

</div>

</form>
@endsection