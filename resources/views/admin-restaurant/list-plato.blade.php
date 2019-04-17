@extends('layouts.app-r')

@section('content')
<div class="container">

    

    <!--Tabla Lista de platos-->
    <div class="row mt-3">

        @if (session('resultado'))
            <div class="col-8">
                <strong>
                    <div class="alert alert-success">{{session('resultado')}}</div>
                </strong>
            </div>
        @endif

        
        @include('includes/slidebar')

        <div class="col-10 col-sm-8 ">

        <!--Titulo-->
        <div class="row mb-2">
            <div class="col-12 ">
                <h4>Lista de platos</h4>
            </div>
        </div>
        <!--Titulo-->

            <table class="table table-responsive table-hover">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Tiempo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dishes as $dish)
                    <tr>
                        <td>
                            <img src="{{ route('dish.image',['filename'=>$dish->image]) }}" class="img-thumbnail " width="50">
                        </td>
                        <td class="text-capitalize">{{$dish->type}}</td>
                        <td>{{$dish->name}}</td>
                        <td>{{$dish->description}}</td>
                        <td>{{$dish->price}}</td>
                        <td>{{$dish->time}}</td>
                        <td>
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{route('adminRestaurant.plato.edit',["id" => $dish->id ])}}" class="btn btn-outline-primary btn-sm">
                                    <img src="https://img.icons8.com/ultraviolet/40/000000/edit.png" width="18">
                                </a>
                                <a href="{{route('adminRestaurant.plato.delete',["id" => $dish->id ])}}" class="btn btn-outline-danger btn-sm">
                                    <img src="https://img.icons8.com/color/48/000000/cancel.png"  width="18">
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                        

                </tbody>
            </table>

        </div>
    </div>
    <!--Tabla Carrito de compras-->

</div>
@endsection