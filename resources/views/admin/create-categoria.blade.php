@extends('layouts.app-a')

@section('content')
         <div class="container-fluid mt-3">
    <form action="{{route('admin.categorias.save')}}" method="post" enctype="multipart/form-data">

    <!--Formulario de Registro-->
    <div class="row ">

   

    <div class="col-12 col-md-9 col-lg-8 mb-3">

    <div class="card shadow p-4 ">

        <div class="row">
            <dt class="col-12">
                @if (isset($categorias))
                    Editar categoria
                    <input type="hidden" name="editar" value="editar">
                    <input type="hidden" name="id" value="{{ $categorias->id ?? '' }}">
                @else
                    Nuevo categoria
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
                    <input type="text" class="form-control" name="name" value="{{ $categorias->name ?? '' }}" placeholder="Nombre" id="name" required>

                </div>
                <div class="form-group col-12  col-md-6 ">
                    <label for="state">Estado</label>
                    <input type="text" class="form-control" name="state" value="{{ $categorias->state ?? '' }}" placeholder="Estado" id="state" required>
                </div>
                <div class="form-group col-12 ">
                    <label for="description">Descripción</label>

                    <textarea class="form-control" name="description" id="description" required>{{ $categorias->description ?? '' }}</textarea>
                </div>
            </div>

            <div class="form-row ">

                <div class="form-group col-12 ">
                <input type="submit" class="btn btn-primary btn-block" name="btnAgregar" value="@if(isset($categorias)){{'Editar'}}@else{{'Agregar'}}@endif">
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
