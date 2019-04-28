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
                <strong >Reporte Restaurantes por Categoria</strong>
            </div>
        </div>

            <table class="table table-sm mt-5">
                <thead class="thead-light ">
                    <tr>
                    <th>#</th>
                    <th>Categoria</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Telefono</th>
                    <th>Ingreso</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $cantidad=0; ?>

                    @foreach ($data as $restaurant)
                    <?php $cantidad++; ?>
                            <tr>
                            <td>{{$cantidad}}</td>
                            <td>{{$restaurant->categoria}}</td>
                            <td>{{$restaurant->name}}</td>
                            <td>{{$restaurant->address}}</td>
                            <td>{{$restaurant->telephone}}</td>
                            <td>{{ substr($restaurant->created_at,0,10) }}</td>
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
                        <td><strong>Fecha de impresión :</strong></td>
                        <td><strong>{{$date}}</strong></td>
                    </tr>

                    @foreach ($data2 as $data)
                        <tr class="mb-3 fila-resultados">
                            <td><strong>{{$data->categoria}}</strong></td>
                            <td><strong>{{$data->total}}</strong></td>
                        </tr>
                    @endforeach


                </tbody>

            </table>

</body>
</html>
