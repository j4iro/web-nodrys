<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte pedidos completados</title>
    <link rel="stylesheet" href="{{asset('css/pdf.css')}}">
</head>
<body>
    <div class="container-fluid">

            <img class="encabezado" src="{{asset('images/favicon/favicon.png')}}" width="50">
            <center>
                <strong>Historial de pedidos completados</strong>
            </center>


            <table >
                <thead class="bg-plomo">
                    <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Distrito</th>
                    <th>Fecha y Hora</th>
                    <th>Ocasión</th>
                    <th>Estado</th>
                    <th>Total</th>

                    </tr>
                </thead>

                <tbody>

                    <?php $cantidad=0; ?>
                    <?php $total=0; ?>

                    @foreach ($data as $cliente_pedido)
                    <?php $cantidad++; ?>
                            <tr>
                            <th>{{$cantidad}}</th>
                            <td>{{$cliente_pedido->username}} {{$cliente_pedido->usersurname}}</td>
                            <td>{{$cliente_pedido->distrito}}</td>
                            <td>{{$cliente_pedido->created_at}}</td>
                            <td>{{$cliente_pedido->oca_special}}</td>
                            <td>{{$cliente_pedido->state}}</td>
                            <td>S/. {{$cliente_pedido->total}}</td>
                        </tr>
                        <?php $total+=$cliente_pedido->total; ?>
                    @endforeach

                </tbody>
            </table>

              <table class="w-50">
                <thead class="bg-plomo">
                    <tr><th colspan="2">Resultados</th></tr>
                </thead>

                <tbody>
                    <tr>
                        <th class="text-left" >Fecha   : </th>
                        <td>{{$date}}</td>
                    </tr>
                    <tr>
                        <th class="text-left" >Suma de total:</th>
                        <td>S/. {{$total}}</td>
                    </tr>
                    <tr>
                        <th  class="text-left">Total de registros   : </th>
                        <td>{{$cantidad}}</td>
                    </tr>

                </tbody>

            </table>

</body>
</html>
