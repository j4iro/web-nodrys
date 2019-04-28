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
            width: 30%;
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
                <strong >Reporte Clientes Registrados</strong>
            </div>
        </div>

            <table class="table table-sm mt-5">
                <thead class="thead-light ">
                    <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Contacto</th>
                    <th>Distrito</th>
                    <th>F. Registro</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $cantidad=0; ?>

                    @foreach ($data as $cliente)
                    <?php $cantidad++; ?>
                            <tr>
                            <td>{{$cantidad}}</td>
                            <td>{{$cliente->name}} {{$cliente->surname}}</td>
                            <td>{{$cliente->email}} - {{$cliente->telephone}}</td>
                            <td>{{$cliente->distrito}}</td>
                            <td>{{ substr($cliente->created_at,0,10) }}</td>
                        </tr>
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
                        <td ><strong>Total de registros   : </strong></td>
                        <td><strong>{{$cantidad}}</strong></td>
                    </tr>
                </tbody>

            </table>

</body>
</html>
