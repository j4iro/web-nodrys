@extends('layouts.app-a')


@section('content')
<div class="container-fluid mt-3">
    <div class="row">

        @include('includes/slidebar-admin')
    <div class="col-10">

            <!--Titulo-->
            <div class="row ">
            <div class="col-12">
                <h4>Solicitudes Pendientes</h4>
            </div>

            <div class="col-12 mt-2">

                <table class="table table-responsive table-hover">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Slogan</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Dirección</th>
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
                            <th scope="row">
                                <img src="{{ route('restaurant.image',['filename'=>$solicitud->image]) }}" width="50" class="img-fluid img-thumbnail shadow-sm avatar">
                            </th>
                            <td>{{$solicitud->name}}</td>
                            <td>{{$solicitud->slogan}}</td>
                            <td>{{$solicitud->description}}</td>
                            <td>{{$solicitud->address}}</td>
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
