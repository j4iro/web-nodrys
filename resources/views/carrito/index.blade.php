@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row mt-3">
        <div class="col-12 ">
            <h4>Mi Carrito
                @if (isset($_SESSION['carrito']) && count($_SESSION['carrito'])>=1)
                    <span class="badge badge-warning">{{count($_SESSION['carrito'])}}</span>
                @endif
            </h4>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12 ">

            <table class="table table-responsive table-hover">
                <thead class="thead-light">
                    <tr>
                    <th scope="col">Imagen</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Plato</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Sub Total</th>
                    <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

            @if (isset($_SESSION['carrito']) && count($_SESSION['carrito'])>=1)
                <?php $total=0; ?>
                 @foreach ($carrito as $indice=>$dish)
                 <?php $plato = $dish['plato']; ?>
                    <tr>
                    <th scope="row">
                        <img src="{{ route('dish.image',['filename'=>$plato->image]) }}" class="img-thumbnail shadow" width="50">
                    </th>
                    <td>{{$plato->type}}</td>
                    <td>{{$plato->name}}</td>
                    <td>{{$plato->price}}</td>
                    <th scope="row"><a href="" class="btn btn-outline-success btn-sm rounded p-0 px-2 mb-1 mr-1">+</a> {{$dish['unidades']}}
                        <a href="" class="btn btn-outline-success btn-sm rounded p-0 px-2 mb-1 ml-1">-</a>
                    </th>
                    <?php $subtotal= $plato->price*$dish['unidades']; ?>
                    <?php $total += $subtotal; ?>
                    <th scope="row">{{number_format($subtotal,2,'.',' ')}}</th>
                    <td><a href="{{route('carrito.deleteone',['indice'=>$indice])}}" class="btn btn-danger btn-sm">Quitar</a></td>
                    </tr>
                @endforeach
            @else
                <tr>
                <th scope="row">-</th>
                <th scope="row" colspan="5" class="text-center">Aún no has agregado productos</th>
                <td>-</td>
                </tr>
            @endif
                
            @if (isset($_SESSION['carrito']) && count($_SESSION['carrito'])>=1)
                <tr>
                    <td><a href="{{route('carrito.deleteall')}}">Vaciar Carrito</a></td>
                    <td colspan="3"></td>
                    <th class="text-right">Total:</th>
                    <th>{{number_format($total,2,'.',' ')}}</th>
                    <th><input type="submit" class="btn btn-primary btn-sm" value="Reservar"></th>
                </tr>
            @endif

                </tbody>
            </table>

        </div>
    </div>

   


</div>
@endsection