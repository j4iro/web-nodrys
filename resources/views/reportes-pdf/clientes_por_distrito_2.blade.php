<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Clientes por Distrito</title>
    <link rel="stylesheet" href="{{asset('css/pdf.css')}}">
</head>
<body>
    <div class="container-fluid">

        <img class="encabezado" src="{{asset('images/favicon/favicon.png')}}" width="50">
        <center>
                <strong >Reporte de clientes y su distrito</strong>
        </center>

            <table >
                <thead class="bg-plomo">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombres</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Email</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Puntos</th>
                        <th scope="col">Distrito</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $cantidad=0; ?>

                    @foreach ($data as $cliente)
                    <?php $cantidad++; ?>
                            <tr>
                            <th>{{$cantidad}}</th>
                            <td>{{$cliente->name}}</td>
                            <td>{{$cliente->surname}}</td>
                            <td>{{$cliente->email}}</td>
                            <td>{{$cliente->telephone}}</td>
                            <td>{{$cliente->points}}</td>
                            <td>{{$cliente->distrito}}</td>
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
                </tbody>

            </table>



</body>
</html>
