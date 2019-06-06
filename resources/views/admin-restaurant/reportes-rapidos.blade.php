@extends('layouts.app-r')

@section('content')

            <!--Titulo-->
            <div class="row ">

            <div class="col-12">
                <strong class="navbar-brand p-0">Reportes predeterminados</strong>
                <hr>
            </div>


            <div class="col-12 mt-2">

                <table class="table  table-hover">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">¿Qué desea saber?</th>
                        <th scope="col">PDF</th>
                        <th scope="col">EXCEL</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- FILA --}}
                        <tr>
                            <th scope="row">1</th>
                            <th scope="row">Historial de pedidos completados</th>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a target="blank" href="{{route('adminRestaurant.pedidos-completados',['tipo'=>'ver'])}}" class="btn btn-danger btn-sm">Ver</a>
                                    <a href="{{route('adminRestaurant.pedidos-completados',['tipo'=>'descargar'])}}" class="btn btn-danger btn-sm">Descargar</a>
                                </div>
                            </td>

                        <td><a href="/admin-restaurante/reportes/excel/pedidos-c" class="btn btn-success btn-sm">Descargar</a></td>
                        </tr>
                        {{-- FILA --}}

                        {{-- FILA --}}
                        <tr>
                            <th scope="row">2</th>
                            <th scope="row">Historial de pedidos pendientes</th>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a target="blank" href="{{route('adminRestaurant.pedidos-pendientes',['tipo'=>'ver'])}}" class="btn btn-danger btn-sm">Ver</a>

                                    <a href="{{route('adminRestaurant.pedidos-pendientes',['tipo'=>'descargar'])}}" class="btn btn-danger btn-sm">Descargar</a>
                                </div>
                            </td>

                            <td><a href="/admin-restaurante/reportes/excel/pedidos-p" class="btn btn-success btn-sm">Descargar</a></td>
                        </tr>
                        {{-- FILA --}}

                        {{-- FILA --}}
                        <tr>
                            <th scope="row">3</th>
                            <th scope="row">Historial de platos</th>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a target="blank" href="{{route('adminRestaurant.platos',['tipo'=>'ver'])}}" class="btn btn-danger btn-sm">Ver</a>

                                    <a href="{{route('adminRestaurant.platos',['tipo'=>'descargar'])}}" class="btn btn-danger btn-sm">Descargar</a>
                                </div>
                            </td>

                            <td><a href="/admin-restaurante/reportes/excel/platos" class="btn btn-success btn-sm">Descargar</a></td>
                        </tr>
                        {{-- FILA --}}



                    </tbody>
                </table>

            </div>
        </div>
 @endsection
