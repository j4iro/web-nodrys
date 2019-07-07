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
                        <th scope="col">min. restantes</th>
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
                <div class="row m-1 p-1 border">
                    <div class="col-md-6">
                        cliente apellidos(ocacion especial)<br>
                        <span><b>Nro. Personas: </b>2</span><br>
                        <b>+51 999999999</b>
                    </div>
                    <div class="col-md-4">
                        <b>hora: </b>00:00:00 <br>
                        <b>restan: </b>00 min
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-centr">
                        <button type="button" name="button" class="btn btn-outline-primary">details</button>
                    </div>
                </div>
                <div class="row m-1 p-1 border">
                    <div class="col-md-6">
                        cliente apellidos(ocacion especial)<br>
                        <span><b>Nro. Personas: </b>2</span><br>
                        <b>+51 999999999</b>
                    </div>
                    <div class="col-md-4">
                        <b>hora: </b>00:00:00 <br>
                        <b>restan: </b>00 min
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-centr">
                        <button type="button" name="button" class="btn btn-outline-primary">details</button>
                    </div>
                </div>
                <div class="row m-1 p-1 border">
                    <div class="col-md-6">
                        cliente apellidos(ocacion especial)<br>
                        <span><b>Nro. Personas: </b>2</span><br>
                        <b>+51 999999999</b>
                    </div>
                    <div class="col-md-4">
                        <b>hora: </b>00:00:00 <br>
                        <b>restan: </b>00 min
                    </div>
                    <div class="col-md-2 d-flex justify-content-center align-items-centr">
                        <button type="button" name="button" class="btn btn-outline-primary">details</button>
                    </div>
                </div>

            </div>
        </div>



 @endsection
