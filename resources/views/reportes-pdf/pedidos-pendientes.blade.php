<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link rel="stylesheet" href="{{asset('css/pdf.css')}}">
    <style>

        /* @import url('https://fonts.googleapis.com/css?family=Acme'); */

        h1, h3
        {
            font-family: Arial, Helvetica, sans-serif;
        }

        .table
        {
            font-size: 0.85rem;
        }

        .encabezado
        {
            position: fixed;
        }

        .table-resultados
        {
            width: 35%;
        }

        body
        {
            background: white;
        }

    </style>
</head>
<body>
    <div class="container-fluid">

        <div class="row ">
            <div class="col-6 ">
                <img class="encabezado" src="{{asset('images/favicon/favicon.png')}}" width="50">
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-12 text-center">
                <strong>Historial de pedidos pendientes</strong>
            </div>
        </div>

            <table class="table table-sm mt-5">
                <thead class="thead-light ">
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
                            <td>{{$cantidad}}</td>
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

              <table class="table table-sm mt-5 table-resultados">
                <thead class="thead-light ">
                    <tr>
                        <th colspan="2">Resultados</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td ><strong>Fecha   : </strong></td>
                        <td><strong>{{$date}}</strong></td>
                    </tr>
                    <tr>
                        <td ><strong>Suma de total:</strong></td>
                        <td><strong>S/. {{$total}}</strong></td>
                    </tr>
                    <tr>
                        <td ><strong>Total de registros   : </strong></td>
                        <td><strong>{{$cantidad}}</strong></td>
                    </tr>

                </tbody>

            </table>

</body>
</html>
