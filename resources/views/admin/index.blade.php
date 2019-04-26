@extends('layouts.app-a')

@section('content')
<div class="container-fluid mt-3">
    <div class="row">

        @include('includes/slidebar-admin')
    <div class="col-12 col-md-9 col-lg-10 mb-3">

            <!--Titulo-->
            <div class="row ">
            <div class="col-12">
                <strong class="navbar-brand p-0">{{ count($solicitudes) . $titulo}}</strong>
            </div>

            <div class="col-12 mt-2">

                <table class="table table-responsive table-hover">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">Código</th>
                        <th scope="col" colspan="2">Restaurante</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha y hora de registro</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Puntos</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Distrito</th>
                        <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach ($solicitudes as $solicitud)
                        <tr>
                            <th scope="row"> SOL-{{$solicitud->id}}</th>
                            <th scope="row">
                                <img src="{{ route('restaurant.image',['filename'=>$solicitud->image]) }}" width="50" class="img-fluid img-thumbnail shadow-sm avatar">
                            </th>
                            <td>{{$solicitud->name}}</td>
                            <td>
                                @if ($solicitud->state==1)
                                    <strong class="text-danger">Nueva</strong>
                                @else
                                    <strong class="text-primary">Atendida</strong>
                                @endif
                            </td>
                            <td>{{$solicitud->created_at}}</td>
                            <td>{{$solicitud->email}}</td>
                            <td>{{$solicitud->telephone}}</td>
                            <td>{{$solicitud->points}}</td>
                            <td>{{$solicitud->categoria}}</td>
                            <td>{{$solicitud->distrito}}</td>

                            <td>
                                <a href="{{route('admin.restaurant.show-solicitud',["id" => $solicitud->id ])}}" class="btn btn-outline-primary btn-sm">
                                    Ver
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
        <!--Titulo-->
        </div>
    </div>
</div>
 @endsection
