@extends('layouts.app-a')

@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        @include('includes/slidebar-admin')
    <div class="col-12 col-md-9 col-lg-10 mb-3">

            <!--Titulo-->
            <div class="row ">

            <div class="col-12">
                <strong class="navbar-brand p-0">Reportes predeterminados</strong>
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
                            <th scope="row">Restaurantes registrados</th>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a target="blank" href="{{route('admin.reportes.restaurantes',['tipo'=>'ver'])}}" class="btn btn-danger btn-sm">Ver</a>
                                    <a href="{{route('admin.reportes.restaurantes',['tipo'=>'descargar'])}}" class="btn btn-danger btn-sm">Descargar</a>
                                </div>
                            </td>

                        <td><a href="{{route('admin.excel.restaurantes')}}" class="btn btn-success btn-sm">Descargar</a></td>
                        </tr>
                        {{-- FILA --}}

                        {{-- FILA --}}
                        <tr>
                            <th scope="row">2</th>
                            <th scope="row">Restaurantes agrupados por distrito </th>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a target="blank" href="{{route('admin.reportes.restaurantes-por-distrito',['tipo'=>'ver'])}}" class="btn btn-danger btn-sm">Ver</a>
                                    <a href="{{route('admin.reportes.restaurantes-por-distrito',['tipo'=>'descargar'])}}" class="btn btn-danger btn-sm">Descargar</a>
                                </div>
                            </td>

                            <td><a href="{{route('admin.excel.restaurantes-distrito')}}" class="btn btn-success btn-sm">Descargar</a></td>
                        </tr>
                        {{-- FILA --}}

                        {{-- FILA --}}
                        <tr>
                            <th scope="row">3</th>
                            <th scope="row">Restaurantes agrupados por categoria </th>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a target="blank" href="{{route('admin.reportes.restaurantes-por-categoria',['tipo'=>'ver'])}}" class="btn btn-danger btn-sm">Ver</a>
                                    <a href="{{route('admin.reportes.restaurantes-por-categoria',['tipo'=>'descargar'])}}" class="btn btn-danger btn-sm">Descargar</a>
                                </div>
                            </td>

                            <td><a href="{{route('admin.excel.restaurantes-categoria')}}" class="btn btn-success btn-sm">Descargar</a></td>
                        </tr>
                        {{-- FILA --}}

                        {{-- FILA --}}
                        <tr>
                            <th scope="row">4</th>
                            <th scope="row"> Clientes registrados </th>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a target="blank" href="{{route('admin.reportes.clientes',['tipo'=>'ver'])}}" class="btn btn-danger btn-sm">Ver</a>
                                    <a href="{{route('admin.reportes.clientes',['tipo'=>'descargar'])}}" class="btn btn-danger btn-sm">Descargar</a>
                                </div>
                            </td>

                            <td><a href="{{route('admin.excel.clientes')}}" class="btn btn-success btn-sm">Descargar</a></td>
                        </tr>
                        {{-- FILA --}}

                         {{-- FILA --}}
                         <tr>
                            <th scope="row">5</th>
                            <th scope="row">Clientes agrupados por distrito </th>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a target="blank" href="{{route('admin.reportes.clientes-por-distrito',['tipo'=>'ver'])}}" class="btn btn-danger btn-sm">Ver</a>
                                    <a href="{{route('admin.reportes.clientes-por-distrito',['tipo'=>'descargar'])}}" class="btn btn-danger btn-sm">Descargar</a>
                                </div>
                            </td>

                            <td><a href="{{route('admin.excel.clientes-distrito')}}" class="btn btn-success btn-sm">Descargar</a></td>
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
