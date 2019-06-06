<!DOCTYPE html>
{{-- <html lang="{{ str_replace('_', '-', app()->getLocale()) }}"> --}}
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Panel Restaurantes</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.4.0.min.js">
    </script>




    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/png"  href="{{asset('images/favicon/favicon.png')}}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel sticky-top">
            <div class="container-fluid">
                <a class="navbar-brand p-0" href="{{ route('adminRestaurant.index') }}">
                    {{-- config('app.name', 'Laravel') --}}
                    <img class="p-0 img-fluid" src="{{asset('svg/logo.svg')}}" width="40" alt="Nodrys">
                <strong>{{session('nombre_restaurante')}}
                             
             </strong>
             <div class="badge badge-primary">{{"Comisión S/.".number_format(session('debePagar'),2)}}</div>
                
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">

                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
                <div class="container-fluid mt-3">
                        <div class="row ">

                        @include('includes/slidebar')

                            <div class="col-12 col-md-9 col-lg-10 mb-3">
                                @yield('content')
                            </div>
                        </div>
                </div>
        </main>
    </div>

    @yield('scripts')
    <script type="text/javascript">

        function cambiardisponibilidad()
        {
            var finalUrl = {!! json_encode(url('/')) !!}+ "/admin-restaurante/cambiar-disponibilidad";
            $.get( finalUrl,function( data ) {
                if(data=="0"){
                    labeldisponibilidad.innerHTML = "CERRADO";
                }else{
                    labeldisponibilidad.innerHTML = "ABIERTO";
                }
              //  alert(data);
            });
        }
    </script>
    <script type="text/javascript">

    window.onload=function(){



        var icono = {!! json_encode(asset('images/favicon/favicon.png')) !!};
        Notification.requestPermission();

        function mostrarNotificacion(titulo,descripcion,tag="solo") {
            var n;
            if(Notification) {
                opciones = {
                         icon: icono,
                         body: descripcion

                     };

                     if (Notification.permission == "granted") {
                        n = new Notification(titulo, opciones);
                     }

                     else if(Notification.permission == "default") {
                         alert("Primero da los permisos de notificación");
                     }

                     else {
                         alert("Bloqueaste los permisos de notificación");
                     }
            }
            n.onclick=function(){
                window.location="/";
            }
        }

        var numOrdenes=0;
        if(typeof(EventSource) !== "undefined") {

            var finalUrl = {!! json_encode(url('/')) !!}+"/admin-restaurante/serve";
            var source = new EventSource(finalUrl);

            source.onmessage = function(event) {
                // en este if evaluamos si tenemos registros de ordenes
                if (event.data!="") {

                    var arrayOrders=event.data.split(";");
                    var updatedNumOrders=arrayOrders.length;

                    var tituloNotificacion="Hay nuevas Ordenes"
                    if ('{{session('ventana')}}'=='inicio') {

                        llenaTabla(arrayOrders);

                        
                    }else {

                    }

                    // console.log(numOrdenes);
                    // console.log(arrayOrders.length);
                    if (numOrdenes!=updatedNumOrders) {
                        if(numOrdenes>updatedNumOrders){
                            tituloNotificacion="Una orden menos"
                        }
                        if(numOrdenes<updatedNumOrders){
                            tituloNotificacion="Nueva Orden"
                        }
                        mostrarNotificacion(tituloNotificacion,"tiene "+arrayOrders.length+" ordenes pendientes");
                    }

                    // esto es importante para mostrar las notificaciones
                    numOrdenes=arrayOrders.length;

                }else {
                    if ('{{session('ventana')}}'=='inicio') {

                        pedidos.innerHTML="No hay registros";
                    }else {

                    }

                    // significa que no hay registros
                }
            };
        }
        else
        {
            document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
        }





    }

    function llenaTabla(arrayOrders){
                 var reservas=[];
                 for (var i = 0; i < arrayOrders.length; i++) {
                         var aux=arrayOrders[i].split(',');
                         reservas.push(aux);
                 }
                 // http://127.0.0.1:8001/admin-restaurante/pedidos-pendientes/detalle/10
                 var horaActual=new Date();
                 pedidos.innerHTML="";
                 for (var i = 0; i < reservas.length; i++) {
                     var cliente=reservas[i][1]+" "+reservas[i][2];
                     var id=reservas[i][10];
                     var url={!! json_encode(url('/'))!!}+"/admin-restaurante/pedidos-pendientes/detalle/"+id;
                     var hora=reservas[i][5].split(":");
                     var restante=((hora[0]*60+parseInt(hora[1]))+{{session('tolerancia')}})-(horaActual.getHours()*60+horaActual.getMinutes());
                     //console.log(tolerancia.value);


                     var estado=reservas[i][9];
                     if (estado=="pendiente") {
                         estado="<td class='text-danger text-uppercase'><span class='badge badge-danger'>Pendiente</span></td>";
                     }else {
                         estado="<td class='text-primary text-uppercase'><span class='badge badge-primary'>Cancelado</span></td>";
                     }
                     if(restante<0){
                         invalidar_Orden(id)
                         estado="<td class='text-danger text-uppercase'><span class='badge badge-alert'>Vencido</span></td>";
                     }

                     var cadena="<tr>\
                     <td>"+cliente+"</td>\
                     <td>"+reservas[i][3]+"</td>\
                     <td>"+reservas[i][4]+"</td>\
                     <td>"+hora[0]+":"+hora[1]+":"+hora[2]+"</td>\
                     <td>"+horaActual.getHours()+":"+horaActual.getMinutes()+":"+horaActual.getSeconds()+"</td>\
                     <td>"+restante+"</td>\
                     <td>"+reservas[i][6]+"</td>\
                     <td>"+reservas[i][7]+"</td>\
                     <td>"+reservas[i][8]+"</td>"+
                     estado
                     +"\
                     <td><a href="+url+" class='btn btn-outline-primary btn-sm'>Detalles</a></td>\
                     </tr>"
                     pedidos.innerHTML+=cadena;
                 }
    }


             // alert(nose);

             function invalidar_Orden(id_orden){
                var cancelaPath={!! json_encode(route('order.vence'))!!};
                $.get(cancelaPath,{
                    cod_reserva:id_orden
                },function (resultado) {
                    if(resultado=="OK"){
                        console.log("se han cancelado");
                    }else {
                        console.log(resultado);
                    }
                });

             }
    </script>

</body>
</html>
