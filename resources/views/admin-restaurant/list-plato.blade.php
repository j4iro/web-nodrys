@extends('layouts.app-r')
@section('scripts')
    <script type="text/javascript" src="{{asset('js/js/ajax.js')}}"></script>
@endsection
@section('content')

        <!--Titulo-->
        <div class="row mb-2">
            <div class="col-12 ">
                <strong class="navbar-brand p-0">Mis platos a ofrecer</strong>
            </div>
        </div>
        <!--Titulo-->

        @if (session('resultado'))
            <div class="row mb-2">
                <div class="col-12">
                    <strong><div class="alert alert-success">{{session('resultado')}}</div></strong>
                </div>
            </div>
        @endif

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
                        <th scope="col">Activar</th>
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
                        <td>
                            <label class="switch" >
                                <input id="{{$dish->id}}" type="checkbox" @if($dish->state)==1) {{'checked'}} @endif onchange="actualizar_estado_plato(this.id)">
                                <span class="slider round"></span>
                            </label>
                        </td>
                    </tr>
                    @endforeach


                </tbody>
            </table>

@endsection
