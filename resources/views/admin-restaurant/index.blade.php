 @extends('layouts.app-r')

@section('content') 
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <h3>Panel de control del restaurante</h3>
            <a href="{{route('adminRestaurant.plato.new')}}" class="btn btn-primary mt-2">Agregar Plato</a><br>
            <a href="{{route('adminRestaurant.plato.list')}}" class="btn btn-primary mt-2">Ver Plato</a><br>
            <hr>
            <a href="{{route('adminRestaurant.orders.all')}}" class="btn btn-primary mt-2">Ver Pedidos Pendientes</a><br>
            <a href="" class="btn btn-primary mt-2">Ver Pedidos Completados</a><br>
            <hr>
            <a href="" class="btn btn-primary mt-2">Datos de mi cuenta</a><br>
            <a href="{{route('adminRestaurant.orders.qr')}}" class="btn btn-primary mt-2">Escanear el QR</a><br>
            <a href="" class="btn btn-primary mt-2">Reportes</a><br>
        </div>
    </div>
</div>
 @endsection
