@extends('layouts.app-r')

@section('content')
{{-- {{$pedidos}} --}}
<div class="container-fluid mt-3">

    <!--Titulo-->
    <div class="row mt-3">


        @include('includes/slidebar')


        <div class="col-12 col-md-9 col-lg-10 mb-3">

            <!--Titulo-->
            <div class="row mb-2">
                <div class="col-12 ">
                    <strong class="navbar-brand p-0">Pedidos Completados</strong>
                </div>
            </div>
            <!--Titulo-->

            <table class="table table-responsive table-hover">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">Cliente</th>
                    <th scope="col">Celular</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Ocasión Especial</th>
                    <th scope="col">N° Personas</th>
                    <th scope="col">Total</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Detalles</th>
                    </tr>
                </thead>
                <tbody>

                @foreach ($pedidos as $pedido)
                    <tr>
                        <th scope="row">{{$pedido->name .' '. $pedido->surname}}</th>
                        <td>{{$pedido->telephone}}</td>
                        <td>{{$pedido->date}}</td>
                        <td>{{$pedido->hour}}</td>
                        <td class="text-capitalize">{{$pedido->oca_special}}</td>
                        <td>{{$pedido->n_people}}</td>
                        <td>{{$pedido->total}}</td>
                        @if ($pedido->state=='pendiente')
                            <td class="text-danger text-uppercase"><span class="badge badge-danger">{{$pedido->state}}</span></td>
                        @else
                            <td class="text-success text-uppercase"><span class="badge badge-success">{{$pedido->state}}</span></td>
                        @endif

                        <td><a href="{{route('adminRestaurant.pedidos.detail',["id"=>$pedido->id])}}" class="btn btn-outline-primary btn-sm">Detalles</a></td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
    </div>
    <!--Titulo-->

</div>
 @endsection
