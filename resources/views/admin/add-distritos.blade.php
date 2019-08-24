@extends('layouts.app-a')

@section('content')
<div class="container-fluid ">
    <form action="{{route('admin.distritos.save')}}" method="post" enctype="multipart/form-data">
        {{csrf_field()}}

    <!--Formulario de Registro-->
    <div class="row ">
    <div class="col-12 col-md-9 col-lg-8 mb-3">

    <div class="card shadow p-4 ">
        <div class="row">
            <dt class="col-12">
                @if (isset($distritos))
                    Editar Distrito
                    <input type="hidden" name="editar" value="editar">
                    <input type="hidden" name="id" value="{{ $distritos->id ?? '' }}">
                @else
                    Nuevo Distrito
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



            <div class="form-row ">
                <div class="form-group col-12  col-md-6 ">
                    <label for="name">Nombre</label>
                    <input type="text" class="form-control" name="name" value="{{ $distritos->name ?? '' }}" placeholder="Nombre" id="name" required>

                </div>
                <div class="form-group col-12  col-md-6 ">

                    <label for="state">Estado</label>
                    <select name="state" class="form-control" required>
                        <option value="1" selected>Activado</option>
                        <option value="0">Desactivado</option>
                    </select>

                    {{-- <input type="number" value="1" class="form-control" name="state" value="{{ $distritos->state ?? '' }}" placeholder="Estado" id="description" required> --}}

                </div>
                <div class="form-group col-12 ">
                    <label for="description">Descripción</label>

                    <textarea class="form-control" name="description" id="description" placeholder="Escribe una descripción" rows="3" required>{{ $distritos->description ?? '' }}</textarea>
                </div>
            </div>

            <div class="form-row ">

                <div class="form-group col-12 ">
                <input type="submit" class="btn btn-primary btn-block" name="btnAgregar" value="@if(isset($distritos)){{'Editar'}}@else{{'Agregar'}}@endif">
                </div>
                </div>
           </div>


            </div>
        </div>
    </div>

    </div>

<!--Formulario de Registro-->
</form>
@endsection
