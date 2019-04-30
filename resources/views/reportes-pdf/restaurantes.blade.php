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
                <strong >Reporte Restaurantes Registrados</strong>
            </center>


            <table >
                <thead class="bg-plomo" >
                    <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    {{-- <th>Foto</th> --}}
                    <th>Distrito</th>
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
                            <th class="text-left">{{$restaurant->name}}</th>
                            {{-- <td><img src="{{ route('restaurant.image',['filename'=>$restaurant->image]) }}" width="50"></td> --}}
                            <td>{{$restaurant->distrito}}</td>
                            <td>{{$restaurant->address}}</td>
                            <td class="text-center">{{ substr($restaurant->created_at,0,10) }}</td>
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
                        <td ><strong>Fecha de impresión  : </strong></td>
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
