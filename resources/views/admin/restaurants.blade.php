@extends('layouts.app-a')

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        @include('includes/slidebar-admin')
    <div class="col-12 col-md-9 col-lg-10 mb-3">

            <!--Titulo-->
            <div class="row ">
                <div class="col-12">
                    <strong class="navbar-brand p-0">Restaurantes registrados</strong>
                </div>


            <div class="col-12 mt-2">

                <table class="table table-responsive table-hover">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Slogan</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Puntos</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Distrito</th>
                        <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach ($restaurantes as $restaurant)
                        <tr>
                            <th scope="row">
                                <img src="{{ route('restaurant.image',['filename'=>$restaurant->image]) }}" width="50" class="img-fluid img-thumbnail shadow-sm avatar">
                            </th>
                            <td>{{$restaurant->name}}</td>
                            <td>{{$restaurant->slogan}}</td>
                            <td>{{$restaurant->address}}</td>
                            <td>{{$restaurant->points}}</td>
                            <td>{{$restaurant->categoria}}</td>
                            <td>{{$restaurant->distrito}}</td>

                            <td>
                                <a href="{{route('admin.restaurant.edit',["id" => $restaurant->id ])}}" class="btn btn-outline-primary btn-sm">
                                    <img src="https://img.icons8.com/ultraviolet/40/000000/edit.png" width="18">
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
