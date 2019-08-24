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
        if (Notification.permission!=="granted")
        {
            Notification.requestPermission();
        }
        else
        {
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
                        <th scope="col">Restaurante</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha y hora de registro</th>
                        <th scope="col">Contacto</th>
                        <th scope="col">Email</th>
                        <th scope="col">Telefono</th>
                        <th scope="col">Distrito</th>
                        <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach ($solicitudes as $solicitud)
                        <tr>
                            <th scope="row"> SOL-{{$solicitud->id}}</th>
                            <td>{{$solicitud->name_restaurant}}</td>
                            <td>
                                @if ($solicitud->state==1)
                                    <span class="badge badge-danger">Nueva</span>
                                @else
                                    <span class="badge badge-primary">Atendida</span>
                                @endif
                            </td>
                            <td>{{$solicitud->created_at}}</td>
                            <td>{{$solicitud->name_owner}} {{$solicitud->surname_owner}}</td>
                            <td>{{$solicitud->email_owner}}</td>
                            <td>{{$solicitud->telephone_owner}}</td>
                            <td>{{$solicitud->distrito}}</td>

                            <td class="text-center">
                                @if ($solicitud->state==1)
                                <a href="{{route('admin.restaurant.show-solicitud',["id" => $solicitud->id ])}}" class="btn btn-primary btn-sm ">Ver</a>
                                @else
                                -
                                @endif
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
        {{-- <button type="button" onclick="notificar()">Enviar una notificaicon</button> --}}
 @endsection
