<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte</title>
    <link rel="stylesheet" href="{{asset('css/pdf.css')}}">
</head>
<body>
    <div class="container-fluid">

        <img class="encabezado" src="{{asset('images/favicon/favicon.png')}}" width="50">
        <center>
            <strong >Reporte de clientes por distrito</strong>
        </center>

            <table >
                <thead class="bg-plomo">
                    <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Telefono</th>
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
                            <td>{{$cliente->name}}</td>
                            <td>{{$cliente->email}}</td>
                            <td>{{$cliente->telephone}}</td>
                            <td>{{$cliente->distrito}}</td>
                            <td class="text-center">{{ substr($cliente->created_at,0,10) }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

              <table class="w-50">
                <thead class="bg-plomo">
                    <tr><th colspan="2">Resultados</th></tr>
                </thead>

                <tbody>
                    <tr>
                        <th class="text-left" >Fecha de impresión  :</th>
                        <td>{{$date}}</td>
                    </tr>

                    @foreach ($data2 as $data)
                        <tr class="mb-3 fila-resultados">
                            <th class="text-left" >{{$data->distrito}}</th>
                            <td>{{$data->total}}</td>
                        </tr>
                    @endforeach


                </tbody>

            </table>



</body>
</html>
