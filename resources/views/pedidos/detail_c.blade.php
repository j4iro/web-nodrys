@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-3"

            <div class="col-12 ">

                <div class="row mt-3">
                    <div class="col-12 ">
                        <strong class="navbar-brand">Detalle del pedidos</strong>
                    </div>
                </div>

                <table class="table table-responsive table-hover">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col" colspan="2">Plato</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">SubTotal</th>
                        <th scope="col">Tipo</th>

                        </tr>
                    </thead>
                    <tbody>
                   
                    @foreach ($pedidos as $pedido)
                        <tr>
                            <th scope="row" class="p-0 pt-1 pl-2">
                                <img src="{{ route('dish.image',['filename'=>$pedido->image]) }}" width="50" class="img-fluid img-thumbnail shadow-sm avatar">
                            </th>
                            <th scope="row">{{$pedido->name}}</th>
                            <td>{{"S/. ".$pedido->price}}</td>
                            <td>{{sprintf('%03d',$pedido->cant)}}</td>
                            <td>{{"S/. ".number_format($pedido->cant*$pedido->price,2)}}</td>
                            <td class="text-capitalize">{{$pedido->type}}</td>

                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>


        </div>
    </div>
@endsection
