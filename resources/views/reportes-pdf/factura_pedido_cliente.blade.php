<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte</title>
    {{-- <link rel="stylesheet" href="{{asset('css/app.css')}}"> --}}
    <link rel="stylesheet" href="{{asset('css/pdf.css')}}">

</head>

<body>
    <div class="container-fluid">

        <div class="row ">
            <div class="col-6 ">
                <img class="encabezado" src="{{asset('images/favicon/favicon.png')}}" width="50">
            </div>
        </div>

        <div class="row mt-0">
            <div class="col-12 text-center" style="width:100%;text-align:right">
                <strong >Factura de Pedido N° 0000{{$data2->id}}</strong>
            </div>
        </div>

            <table class="table table-sm mt-5" style="padding-top:5%" border="1" style="width:100%">
                <thead class="thead-light ">
                    <tr style="width:100%;text-align:center;">
                        <th colspan="2" style="text-align:center;" >CLIENTE</th>
                    </tr>
                    <tr>
                        <td><strong>Codigo : C-000{{$data2->id_user}}</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Nombres: {{$data2->cliente}} {{$data2->apellidos}}</strong></td>
                    </tr>
                </thead>
            </table>

            <table class="table table-sm mt-3" border="1" style="width:100%;margin-top:2%">
                <thead class="thead-light ">
                    <tr>
                        <th colspan="4" style="text-align:center;">DETALLES DEL PEDIDO</th>
                    </tr>
                </thead>
                <thead class="thead-light ">
                    <tr>
                    <th>#</th>
                    <th>Producto</th>
                    <th>Tipo</th>
                    <th>Precio</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $cantidad=0; ?>

                    @foreach ($data as $detalle)
                    <?php $cantidad++; ?>
                            <tr>
                            <td>{{$cantidad}}</td>
                            <td>{{$detalle->name}}</td>
                            <td>{{$detalle->category_dish}}</td>
                            <td>{{$detalle->price}}</td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

              <table class="table table-sm mt-3 ">
                <thead class="thead-light ">
                    <tr>
                        <th colspan="2" style="text-align:center;" >PEDIDO N° 0000{{$data2->id}}</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><strong>Total :</strong></td>
                        <td><strong>S/. {{$data2->total}}</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Restaurante :</strong></td>
                        <td><strong id="restaurante">{{$data2->name}}</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Dirección :</strong></td>
                        <td><strong>{{$data2->address}}</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Personas :</strong></td>
                        <td><strong>{{$data2->n_people}}</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Fecha y hora:</strong></td>
                        <td><strong>{{$data2->created_at}}</strong></td>
                    </tr>
                </tbody>
            </table>

            <div class="page-break"></div>

            <table class="table table-sm mt-1 ">
                <thead class="thead-light ">
                    <tr>
                        <th colspan="2" style="text-align:center;">CODIGO QR</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <img class="mt-4" src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(300)->margin(0)->generate($data2->id.$data2->created_at.$data2->name)) }} ">
                        </td>
                    </tr>
                </tbody>
            </table>

</body>

</html>
