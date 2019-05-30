 @extends('layouts.app-r')

@php

@endphp
@section('content')
            <!--Titulo-->
            <div class="row ">
            <div class="col-12">
                <strong class="navbar-brand p-0">Pedidos Pendientes</strong>
            </div>

            <div class="col-12 mt-2">
                <table class="table table-responsive table-hover">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">Cliente</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Hora</th>
                        <th scope="col">Hora Actual</th>
                        <th scope="col">Hora restante</th>
                        <th scope="col">Ocasión Especial</th>
                        <th scope="col">N° Personas</th>
                        <th scope="col">Total</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Detalles</th>
                        </tr>
                    </thead>
                    <tbody id="pedidos">


                    </tbody>
                </table>

            </div>
        </div>



 @endsection
