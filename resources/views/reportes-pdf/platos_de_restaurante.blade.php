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
                <strong>Historial de mis platos</strong>
            </div>
        </div>

            <table class="table table-sm mt-5">
                <thead class="thead-light ">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Preparación</th>
                        <th>Precio</th>
                        <th>Creación</th>
                        <th>Categoria</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $cantidad=0; ?>

                    @foreach ($data as $plato)
                    <?php $cantidad++; ?>
                            <tr>
                            <td>{{$cantidad}}</td>
                            <td>{{$plato->name}}</td>
                            <td>{{$plato->time }} Min.</td>
                            <td>{{$plato->price}}</td>
                            <td>{{$plato->created_at}}</td>
                            <td>{{$plato->categoria}}</td>
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
                    <tr>
                        <td ><strong>Total de registros   : </strong></td>
                        <td><strong>{{$cantidad}}</strong></td>
                    </tr>
                </tbody>

            </table>

</body>
</html>
