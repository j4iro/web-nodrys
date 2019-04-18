@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <div class="row mt-3">
        <div class="col-12 ">
            <h4>Mi Historial de pedidos</h4>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-2">
            <label for="form-label-control">Restaurante</label>
            <select class="form-control form-control-sm" name="" id="">
                <option value="1">El buen tomate</option>
                <option value="1">Norkys</option>
            </select>
        </div>
        <div class="col-2">
            <label for="form-label-control">Fecha</label>
            <input class="form-control form-control-sm" type="date" name="" id="">
        </div>
        <div class="col-2">
            <label for="form-label-control">Estado</label>
            <select class="form-control form-control-sm" name="" id="">
                <option value="1">Pendiente</option>
                <option value="1">Terminado</option>
            </select>
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
                    <th scope="col">Fecha - Hora</th>
                    <th scope="col">Personas</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Total</th>
                    {{-- <th scope="col">Acciones</th> --}}
                    <th scope="col" colspan="2">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                @foreach ($pedidos as $pedido)
                    <tr>
                        <th scope="row" class="p-0 pt-1 pl-2">
                            <img src="{{ route('restaurant.image',['filename'=>$pedido->image]) }}" width="50" class="img-fluid img-thumbnail shadow-sm avatar">
                        </th>
                        <th scope="row">{{$pedido->name}}</th>
                        <td>{{$pedido->created_at}}</td>
                        <td>{{$pedido->n_people}}</td>
                        @if ($pedido->state=='pendiente')
                            <td class="text-danger text-uppercase"><span class="badge badge-danger">{{$pedido->state}}</span></td>
                        @else
                            <td class="text-primary text-uppercase"><span class="badge badge-primary">{{$pedido->state}}</span></td>
                        @endif
                        <td>{{$pedido->total}}</td>
                        <td><a href="{{route('pedidos.detail_c',["id"=>$pedido->id])}}" class="btn btn-outline-primary btn-sm">Detalles</a></td>
                        <td>
                            @if ($pedido->state=='pendiente')
                            <a href="{{route('pedidos.detail_c',["id"=>$pedido->id])}}" class="btn btn-outline-danger btn-sm">Cancelar</a>
                            @endif
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>

        </div>
    </div>



</div>
@endsection