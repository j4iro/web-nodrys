<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte</title>
    {{-- <link rel="stylesheet" href="{{asset('css/pdf.css')}}"> --}}
    @include('includes.pdf')
</head>
<body>
    <div class="container-fluid">
    {{-- <img class="encabezado" src="{{asset('images/favicon/favicon.png')}}" width="50"> --}}
    <center>
        <strong >Reporte Clientes Registrados</strong>
    </center>

        <table >
            <thead class="bg-plomo">
                <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Dirección</th>
                <th>Celular</th>
                <th>Distrito</th>
                <th>F. Registro</th>
                </tr>
            </thead>

            <tbody>

                <?php $cantidad=0; ?>

                @foreach ($data as $cliente)
                <?php $cantidad++; ?>
                        <tr>
                        <th>{{$cantidad}}</th>
                        <td>{{$cliente->name}} {{$cliente->surname}}</td>
                        <td>{{$cliente->email}}</td>
                        <td>{{$cliente->telephone}}</td>
                        <td>{{$cliente->distrito}}</td>
                        <td class="text-center">{{ substr($cliente->created_at,0,10) }}</td>
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
