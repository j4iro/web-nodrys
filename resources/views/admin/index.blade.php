@extends('layouts.app-a')
@section('scripts')
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    <script type="text/javascript">

    window.onload=function () {
        var t = setInterval(function(){
            // post::()
            // notificar('uno','genial');
        }, 3000);
    };
    document.addEventListener("DOMContentLoaded",function() {
        if (!Notification) {
            alert("Las notificaciones no estan soportadas en tu navegador")
            return
        }
        if(Notification.permission!=="granted")
            Notification.requestPermission()
    });

    function notificar(titulo,mensaje) {
        if (Notification.permission!=="granted") {
            Notification.requestPermission();
        }else {
            var notificacion=new Notification(titulo,{
                icon:"{{asset('images/favicon/favicon.png')}}",
                body:mensaje
            });
            notificacion.onclick=function(){
                window.open("/");
            }
        }
    }



    </script>
@endsection
@section('content')
            <div class="row ">
            <div class="col-12">
                <strong class="navbar-brand p-0">{{ count($solicitudes) . $titulo}}</strong>
            </div>

            <div class="col-12 mt-2">

                <table class="table table-responsive table-hover">
                    <thead class="thead-light">
                        <tr>
                        <th scope="col">Código</th>
                        <th scope="col" colspan="2">Restaurante</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha y hora de registro</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Puntos</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Distrito</th>
                        <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach ($solicitudes as $solicitud)
                        <tr>
                            <th scope="row"> SOL-{{$solicitud->id}}</th>
                            <th scope="row">
                                <img src="{{ route('restaurant.image',['filename'=>$solicitud->image]) }}" width="50" class="img-fluid img-thumbnail shadow-sm avatar">
                            </th>
                            <td>{{$solicitud->name}}</td>
                            <td>
                                @if ($solicitud->state==1)
                                    <strong class="text-danger">Nueva</strong>
                                @else
                                    <strong class="text-primary">Atendida</strong>
                                @endif
                            </td>
                            <td>{{$solicitud->created_at}}</td>
                            <td>{{$solicitud->email}}</td>
                            <td>{{$solicitud->telephone}}</td>
                            <td>{{$solicitud->points}}</td>
                            <td>{{$solicitud->categoria}}</td>
                            <td>{{$solicitud->distrito}}</td>

                            <td>
                                <a href="{{route('admin.restaurant.show-solicitud',["id" => $solicitud->id ])}}" class="btn btn-outline-primary btn-sm">
                                    Ver
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
        {{-- <button type="button" onclick="notificar()">Enviar una notificaicon</button> --}}
 @endsection
