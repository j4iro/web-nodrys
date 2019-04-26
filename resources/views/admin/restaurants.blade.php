@extends('layouts.app-a')

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        @include('includes/slidebar-admin')
    <div class="col-12 col-md-9 col-lg-10 mb-3">

            <!--Titulo-->
            <div class="row ">
                <div class="col-12">
                <strong class="navbar-brand p-0">{{count($restaurantes)}} restaurantes registrados</strong>
                </div>


            <div class="col-12 mt-2">

                    <div class="row">
                            <div class="col-12">
                                @if (session('resultado'))
                                    <strong>
                                        <div class="alert alert-success">{{session('resultado')}}</div>
                                    </strong>
                                @endif
                            </div>
                        </div>

                <table class="table table-responsive table-hover table-sm">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Slogan</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Puntos</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Distrito</th>
                        <th scope="col" colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach ($restaurantes as $restaurant)
                        <tr>
                            <th scope="row">
                                <img src="{{ route('restaurant.image',['filename'=>$restaurant->image]) }}" width="50" class="img-fluid img-thumbnail shadow-sm avatar">
                            </th>
                            <td>{{$restaurant->name}}</td>
                            <th scope="col">
                                @if ($restaurant->state==1)
                                    Habilitado
                                @else
                                <strong class="text-danger">Deshabilitado</strong>
                                @endif
                            </th>
                            <td>{{$restaurant->slogan}}</td>
                            <td>{{$restaurant->address}}</td>
                            <td>{{$restaurant->points}}</td>
                            <td>{{$restaurant->categoria}}</td>
                            <td>{{$restaurant->distrito}}</td>

                            <td>
                                <a href="{{route('admin.restaurant.edit',["id" => $restaurant->id ])}}" class="btn btn-outline-primary btn-sm">
                                    Editar
                                </a>
                            </td>

                            <td>
                                @if ($restaurant->state==1)
                                    <a href="{{route('admin.restaurantes.update.state',["id" => $restaurant->id ])}}" class="btn btn-outline-danger btn-sm">Deshabilitar</a>
                                @else
                                    <a href="{{route('admin.restaurantes.update.state',["id" => $restaurant->id ])}}" class="btn btn-outline-success btn-sm">Habilitar</a>
                                @endif
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
