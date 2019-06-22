<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    {{-- <link rel="stylesheet" href="{{asset('css/pdf.css')}}"> --}}
    @include('includes.pdf')
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

        .container-fluid
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
                <h3>Reporte de Restaurantes</h3>
            </div>
        </div>

            <table class="table table-sm mt-5">
                <thead class="thead-light ">
                    <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Distrito</th>
                    <th>Dirección</th>
                    <th>Ingreso</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $cantidad=1; ?>

                    @foreach ($data as $restaurant)
                            <tr>
                            <th scope="row">{{$cantidad}}</th>
                            <th scope="row">{{$restaurant->name}}</th>
                            <td>{{$restaurant->distrito}}</td>
                            <td>{{$restaurant->address}}</td>
                            <td>{{ substr($restaurant->created_at,0,10) }}</td>
                        </tr>
                        <?php $cantidad++; ?>
                    @endforeach

                </tbody>
            </table>

              <table class="table table-sm mt-5 table-resultados">
                <thead class="thead-light ">
                    <tr>
                        <th colspan="2" >Resultados</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td >
                            <strong>Fecha   : </strong>
                        </td>
                        <td>
                            {{$date}}
                        </td>
                    </tr>
                    <tr class="mb-3">
                        <td>
                            <strong>Cantidad: </strong>
                        </td>
                        <td>
                            {{count($data) . " registrados"}}
                        </td>
                    </tr>
                </tbody>

            </table>

</body>
</html>
