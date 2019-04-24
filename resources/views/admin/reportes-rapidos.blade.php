@extends('layouts.app-a')

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        @include('includes/slidebar-admin')
    <div class="col-12 col-md-9 col-lg-10 mb-3">

            <!--Titulo-->
            <div class="row ">

            <div class="col-12">
                <h4>Reportes Rápidos</h4>
            </div>


            <div class="col-12 mt-2">

                <table class="table  table-hover">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">PDF</th>
                        <th scope="col">EXCEL</th>
                        </tr>
                    </thead>
                    <tbody>

                        {{-- FILA --}}
                        <tr>
                            <th scope="row"> Restaurantes registrados</th>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a target="blank" href="{{route('admin.resportes.restaurantes',['tipo'=>'ver'])}}" class="btn btn-danger btn-sm">Ver</a>

                                    <a href="{{route('admin.resportes.restaurantes',['tipo'=>'descargar'])}}" class="btn btn-danger btn-sm">Descargar</a>
                                </div>
                            </td>

                        <td><a href="/admin/reportes/excel/restaurantes" class="btn btn-success btn-sm">Descargar</a></td>
                        </tr>
                        {{-- FILA --}}

                        {{-- FILA --}}
                        <tr>
                            <th scope="row"> Restaurantes registrados en el último mes</th>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a target="blank" href="{{route('admin.resportes.restaurantes',['tipo'=>'ver'])}}" class="btn btn-danger btn-sm">Ver</a>

                                    <a href="{{route('admin.resportes.restaurantes',['tipo'=>'descargar'])}}" class="btn btn-danger btn-sm">Descargar</a>
                                </div>
                            </td>

                            <td><a href="" class="btn btn-success btn-sm">Descargar</a></td>
                        </tr>
                        {{-- FILA --}}

                        {{-- FILA --}}
                        <tr>
                            <th scope="row"> Clientes registrados </th>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a target="blank" href="{{route('admin.resportes.restaurantes',['tipo'=>'ver'])}}" class="btn btn-danger btn-sm">Ver</a>

                                    <a href="{{route('admin.resportes.restaurantes',['tipo'=>'descargar'])}}" class="btn btn-danger btn-sm">Descargar</a>
                                </div>
                            </td>

                            <td><a href="/admin/reportes/excel/usuarios" class="btn btn-success btn-sm">Descargar</a></td>
                        </tr>
                        {{-- FILA --}}

                        {{-- FILA --}}
                        <tr>
                            <th scope="row">Clientes registrados en el último mes</th>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a target="blank" href="{{route('admin.resportes.restaurantes',['tipo'=>'ver'])}}" class="btn btn-danger btn-sm">Ver</a>

                                    <a href="{{route('admin.resportes.restaurantes',['tipo'=>'descargar'])}}" class="btn btn-danger btn-sm">Descargar</a>
                                </div>
                            </td>

                            <td><a href="" class="btn btn-success btn-sm">Descargar</a></td>
                        </tr>
                        {{-- FILA --}}


                    </tbody>
                </table>

            </div>
        </div>
        <!--Titulo-->
        </div>
    </div>
</div>
 @endsection
