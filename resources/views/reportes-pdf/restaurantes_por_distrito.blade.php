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
                    <strong >Reporte Restaurantes por Distrito</strong>
                </center>


            <table >
                <thead >
                    <tr class="bg-plomo">
                    <th>#</th>
                    <th>Distrito</th>
                    <th>Nombre</th>
                    <th>Dirección</th>
                    <th>Ingreso</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $cantidad=0; ?>

                    @foreach ($data as $restaurant)
                    <?php $cantidad++; ?>
                        <tr>
                            <th>{{$cantidad}}</th>
                            <td>{{$restaurant->distrito}}</td>
                            <td>{{$restaurant->name}}</td>
                            <td>{{$restaurant->address }}</td>
                            <td class="text-center">{{ substr($restaurant->created_at,0,10) }}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

            <table class="w-50">
                <thead class="bg-plomo" >
                    <tr>
                        <th colspan="2">Resultados</th>
                    </tr>
                </thead>

                <tbody >
                    <tr>
                        <td>Fecha de impresión :</td>
                        <td>{{$date}}</td>
                    </tr>

                    @foreach ($data2 as $data)
                        <tr>
                            <td>{{$data->distrito}}</td>
                            <td>{{$data->total}}</td>
                        </tr>
                    @endforeach

                </tbody>

            </table>

</body>
</html>
