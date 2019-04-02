@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row mt-3">
        <div class="col-12 ">
            <h2>Mi Historial de pedidos</h2>
        </div>
    </div>

    <div class="row mt-3">

        <div class="col-12 col-sm-7 ">
            @if(session('result'))
                <div class="alert alert-success">
                    <strong>{{session('result')}}</strong>
                </div>
            @endif
        </div>

        <div class="col-12 ">
            
            <table class="table table-responsive table-hover">
                <thead class="thead-light">
                    <tr>
                    <th scope="col" colspan="2">Restaurante</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Personas</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Total</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                @foreach ($pedidos as $pedido)
                    <tr>
                        <th scope="row">{{$pedido->restaurant_id}}</th>
                        <th scope="row">El Buen Tomate</th>
                        <td>{{$pedido->date}}</td>
                        <td>{{$pedido->n_people}}</td>
                        @if ($pedido->state=='pendiente')
                            <td class="text-danger text-uppercase">{{$pedido->state}}</td>
                        @else
                            <td class="text-primary text-uppercase">{{$pedido->state}}</td>
                        @endif
                        <td>{{$pedido->total}}</td>
                        <td><a href="{{route('pedidos.detail',["id"=>$pedido->id])}}" class="btn btn-primary btn-sm">Detalles</a></td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
    </div>



</div>
@endsection