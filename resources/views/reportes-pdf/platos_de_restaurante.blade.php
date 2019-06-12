<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte - Historial de platos</title>
    {{-- <link rel="stylesheet" href="{{asset('css/pdf.css')}}"> --}}
    @include('includes.pdf')
</head>
<body>
    <div class="container-fluid">

        {{-- <img class="encabezado" src="{{asset('images/favicon/favicon.png')}}" width="50"> --}}
        <center>
            <strong >Historial de mis platos</strong>
        </center>

            <table>
                <thead class="bg-plomo">
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
                            <th>{{$cantidad}}</th>
                            <td>{{$plato->name}}</td>
                            <td>{{$plato->time }} Min.</td>
                            <td>{{$plato->price}}</td>
                            <td>{{$plato->created_at}}</td>
                            <td>{{$plato->categoria}}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

              <table class="w-50">
                <thead class="bg-plomo">
                    <tr>
                        <th colspan="2">Resultados</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th class="text-left">Fecha de impresión :</th>
                        <td>{{$date}}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Total de registros   : </th>
                        <td>{{$cantidad}}</td>
                    </tr>
                </tbody>

            </table>

</body>
</html>
