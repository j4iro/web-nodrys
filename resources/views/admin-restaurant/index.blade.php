 @extends('layouts.app-r')

@php

@endphp
@section('content')

<div class="container">

<div class="card shadow">
    <div class="card-header font-weight-bold">
        Reservas
    </div>
    <div class="card-body">
        <div class="row ">
            <div class="col-12 mt-2">
                <strong>Reservas para hoy</strong>
                <div class="container" id="pedidos">
                </div>
                <hr>
                <strong>Reservas de otras fechas</strong>
                <div class="container" id="pedidos2">
                </div>
            </div>
        </div>
    </div>
</div>

</div>

 @endsection
