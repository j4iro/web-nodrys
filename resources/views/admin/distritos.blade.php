@extends('layouts.app-a')

@section('content')
            <div class="row ">
                <div class="col-12">
                <strong class="navbar-brand p-0">{{count($distritos)}} distritos registrados</strong>
                </div>


            <div class="col-12 mt-2">

                <div class="row">
                    <div class="col-12">
                        @if (session('resultado'))
                            <strong>
                                <div class="alert alert-success">{{session('resultado')}}</div>
                            </strong>
                        @endif
                        @if (session('error'))
                            <strong>
                                <div class="alert alert-danger">{{session('error')}}</div>
                            </strong>
                        @endif
                    </div>
                </div>

                <table class="table table-responsive table-hover">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Fecha de creación</th>
                        <th scope="col">Última actualización</th>
                        <th scope="col" colspan="2">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach ($distritos as $distrito)
                        <tr>
                            <td>{{$distrito->name}}</td>
                            <th scope="col">
                                @if ($distrito->state==1)
                                    Habilitado
                                @else
                                <strong class="text-danger">Deshabilitado</strong>
                                @endif
                            </th>
                            <td>{{$distrito->description}}</td>
                            <td>{{$distrito->created_at}}</td>
                            <td>{{$distrito->updated_at}}</td>

                            <td>
                                <a href="{{route('admin.distritos.show',["id" => $distrito->id ])}}" class="btn btn-outline-primary btn-sm">
                                    {{-- <img src="https://img.icons8.com/ultraviolet/40/000000/edit.png" width="18"> --}}
                                    Editar
                                </a>
                            </td>
                            <td>
                                @if ($distrito->state==1)
                                    <a href="{{route('admin.distritos.update.state',["id" => $distrito->id ])}}" class="btn btn-outline-danger btn-sm">Deshabilitar</a>
                                @else
                                    <a href="{{route('admin.distritos.update.state',["id" => $distrito->id ])}}" class="btn btn-outline-success btn-sm">Habilitar</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>

 @endsection
