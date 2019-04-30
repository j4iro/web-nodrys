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
            <strong>Reporte Restaurantes por Categoria</strong>
        </center>

            <table >
                <thead class="bg-plomo">
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
                            <th>{{$cantidad}}</th>
                            <td>{{$restaurant->categoria}}</td>
                            <td>{{$restaurant->name}}</td>
                            <td>{{$restaurant->address}}</td>
                            <td>{{$restaurant->telephone}}</td>
                            <td class="text-center">{{ substr($restaurant->created_at,0,10) }}</td>
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
                        <th class="text-left">Fecha de impresión :</th>
                        <th class="text-left">{{$date}}</th>
                    </tr>

                    @foreach ($data2 as $data)
                        <tr >
                            <td>{{$data->categoria}}</td>
                            <td>{{$data->total}}</td>
                        </tr>
                    @endforeach


                </tbody>

            </table>

</body>
</html>
