 @extends('layouts.app-r')

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
 @section('scripts')
     <script type="text/javascript">

var icono = {!! json_encode(asset('images/favicon/favicon.png')) !!};
            Notification.requestPermission();
             function mostrarNotificacion(titulo,descripcion) {
             if(Notification) {

                 opciones = {
                     icon: icono,
                     body: descripcion
                 };

                 if (Notification.permission == "granted") {
                     var n = new Notification(titulo, opciones);
                 }

                 else if(Notification.permission == "default") {
                     alert("Primero da los permisos de notificación");
                 }

                 else {
                     alert("Bloqueaste los permisos de notificación");
                 }
             }
             };

// esto es lo maximo
            var num=0;
            if(typeof(EventSource) !== "undefined") {

            var finalUrl = {!! json_encode(url('/')) !!}+"/admin-restaurante/serve";



               var source = new EventSource(finalUrl);
               source.onmessage = function(event) {

                var n=event.data.split(";");
                if (n.length==num&&num!=0) {


              }else {
                  mostrarNotificacion('Hay nuevas ordenes',"tiene "+n.length+" ordenes pendientes");
              }
                num=n.length;
                // console.log(num);
                var reservas=[];
                for (var i = 0; i < n.length; i++) {
                    var aux=n[i].split(',');
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
                    var restante=(hora[0]*60+parseInt(hora[1]))-(horaActual.getHours()*60+horaActual.getMinutes());



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
               };
             } else {
               document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
             }

             var nose={!! json_encode(route('order.vence'))!!};
             alert(nose);

             function invalidar_Orden(id_orden){
                $.get(nose,{
                    cod_reserva:id_orden
                },function (resultado) {
                    if(resultado=="OK"){
                        alert("se han cancelado con exito");
                    }else {
                        alert(resultado);
                    }
                })

             }
             /*
             $.get( finalUrl,function( data ) {
                 if(data=="0"){
                     labeldisponibilidad.innerHTML = "CERRADO";
                 }else{
                     labeldisponibilidad.innerHTML = "ABIERTO";
                 }
               //  alert(data);
             });
             */

     </script>

 @endsection
