<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte Pedidos</title>
    {{-- <link rel="stylesheet" href="{{asset('css/pdf.css')}}"> --}}
    @include('includes.pdf')
</head>
<body>
    <div class="container-fluid">
    {{-- <img class="encabezado" src="{{asset('images/favicon/favicon.png')}}" width="50"> --}}
    <center>
    <strong>Reporte pedidos de {{$data2[0]}} a {{$data2[1]}}</strong>
    </center>

        <table >
            <thead class="bg-plomo">
                <tr>
                    <th>Item</th>
                    <th>Fecha</th>
                    <th>Hora</th>
                    <th>Estado</th>
                    <th>Ocasión Especial</th>
                    <th>Cliente</th>
                    <th>Distrito</th>
                </tr>
            </thead>

            <tbody>

                <?php $cantidad=0; ?>

                @foreach ($data as $cliente)
                <?php $cantidad++; ?>
                        <tr>
                        <th>{{$cantidad}}</th>
                        <td class="text-center">{{$cliente->date}}</td>
                        <td class="text-center">{{$cliente->hour}}</td>
                        <td class="text-center">{{$cliente->state}}</td>
                        <td class="text-center">{{$cliente->oca_special}}</td>
                        <td class="text-center">{{$cliente->nombre_c}} {{$cliente->apellido_c}}</td>
                        <td class="text-center">{{$cliente->distrito}}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>

    <table class="w-50" >
        <thead class="bg-plomo" >
            <tr><th colspan="2">Resultados</th></tr>
        </thead>

        <tbody>
            <tr>
                <th class="text-left" >Fecha de impresión  :</th>
                <td>{{$date}}</td>
            </tr>
            <tr>
                <th class="text-left" >Total de registros   : </th>
                <td>{{$cantidad}}</td>
            </tr>
        </tbody>

    </table>

</body>
</html>
