@extends('layouts.app-a')

@section('content') 
@section('content') 
<div class="container mt-3">
    <div class="row">
        
        @include('includes/slidebar-admin')
    <div class="col-10">

            <!--Titulo-->
            <div class="row ">
            <div class="col-12">
                <h4>Solicitudes Pendientes</h4>
            </div>
    
            <div class="col-12 mt-2">
                
                <table class="table table-responsive table-hover">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col" >Celular</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Ocasión Especial</th>
                        <th scope="col">N° Personas</th>
                        <th scope="col">Total</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Detalles</th>
                        <th scope="col">Marcar</th>
                        </tr>
                    </thead>
                    <tbody>
    
                    {{-- Foreach --}}
    
                    </tbody>
                </table>
    
            </div>
        </div>
        <!--Titulo-->
        </div>
    </div>
</div>
 @endsection
 @endsection