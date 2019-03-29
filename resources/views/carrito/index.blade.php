@extends('layouts.app')

@section('content')
<div class="container">

    <!--Titulo del carrito-->
    <div class="row mt-3">
        <div class="col-12 ">
            <h4>Mi Carrito
                @if (isset($_SESSION['carrito']) && count($_SESSION['carrito'])>=1)
                    <span class="badge badge-warning border border-secondary">{{count($_SESSION['carrito'])}}</span>
                @endif
            </h4>
        </div>
    </div>
    <!--Titulo del carrito-->

    <!--Tabla Carrito de compras-->
    <div class="row mt-3">
        <div class="col-12 col-sm-8">

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
                    <th scope="row">
                        <a href="{{route('carrito.up',['indice'=>$indice])}}" class="btn btn-outline-success btn-sm rounded p-0 px-2 mb-1 mr-1">+</a> 
                        {{$dish['unidades']}}
                        <a href="{{route('carrito.down',['indice'=>$indice])}}" class="btn btn-outline-success btn-sm rounded p-0 px-2 mb-1 ml-1">-</a>
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
    <!--Tabla Carrito de compras-->

    <!--Formulario de Pago-->
    <div class="row my-3">
        <div class="col-12 col-sm-6">

            <div class="card shadow p-4 bg-light">

                <div class="row">
                    <dt class="col-12">Nueva tarjeta de pago
                        <hr>
                    </dt>
                </div>

                <div class="row mt-2">
                    <div class="col-12">
                        <input type="text" placeholder="Número de tarjeta" class="form-control" name="numeroTarjeta" id="">
                    </div>
                </div>
                
                <div class="row mt-2">
                    <div class="col-4  pr-0">
                        <select name="" class="form-control" id="">
                            <option value="" disabled selected>MM</option>
                            @for ($i = 1; $i < 13; $i++)
                                <option value="{{$i}}"  >{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-4  pl-0">
                        <select name="" class="form-control" id="">
                            <option value="" disabled selected>AAAA</option>
                            @for ($i = 2020; $i < 2040; $i++)
                                <option value="{{$i}}"  >{{$i}}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="col-4">
                        <input type="text" placeholder="CVC" class="form-control" name="cvc" id="">
                    </div>
                </div>
                
                <div class="row mt-2">
                    <div class="col-12">
                        <input type="text" placeholder="Nombre en la tarjeta" class="form-control" name="nombreTarjeta" id="">
                    </div>
                </div>
            
                <div class="row mt-2">
                    <div class="col-8 ">
                        <select name="" class="form-control" id="">
                            <option value="" selected>Perú</option>
                            <option value="" >Colombia</option>
                            <option value="" >Chile</option>
                            <option value="" >Ecuador</option>
                            <option value="" >México</option>
                        </select>
                    </div>
                    <div class="col-4  ">
                        <input type="text" placeholder="Código Postal" class="form-control" name="codigoPostal" id="">
                    </div>
                </div>
                
                <div class="row mt-2">
                    <div class="col-8 ">
                        <div class="form-group form-check">
                            <input type="checkbox" class="form-check-input" checked name="recordarTarjeta" id="recordarTarjeta">
                            <label class="form-check-label" for="recordarTarjeta">Recordar esta tarjeta</label>
                        </div>
                    </div>
                </div>
            
                <div class="row mt-2 ">
                        <div class="col-6">
                            <button type="submit" class="btn btn-danger btn-block btn-lg">Realizar Pago</button>
                        </div>
                        <div class="col-6 ">
                            <small class="form-text text-muted">Al completar la compra aceptas estas <a href="">Condiciones de uso</a></small>
                        </div>
                </div>
            </div>

        </div>
    </div>
    <!--Formulario de Pago-->


</div>
@endsection