@extends('layouts.app-r')

@section('content') 
<div class="container mt-3">
    <div class="row">
        <div class="col-12">
            <h3>Panel de control del administrador</h3>
            <a href="{{route('adminRestaurant.plato.new')}}" class="btn btn-primary mt-2">Agregar Restaurante</a><br>
            <a href="{{route('adminRestaurant.plato.list')}}" class="btn btn-primary mt-2">Ver Restaurantes</a><br>
            
            <a href="{{route('adminRestaurant.reportes')}}" class="btn btn-primary mt-2">Reportes</a><br>
        </div>
    </div>
</div>
 @endsection