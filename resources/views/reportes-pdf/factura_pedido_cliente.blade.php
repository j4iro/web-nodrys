<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura</title>
    {{-- <link rel="stylesheet" href="{{asset('css/pdf.css')}}"> --}}
    @include('includes.pdf')
</head>
<body>
    <div class="container-fluid">

        <center>
            <strong class="titulo-factura" >COMPROBANTE DE PEDIDO N° 0000{{$data2->id}}</strong>
        </center>

            <table>
                <thead>
                    <tr>
                        <th colspan="2">CLIENTE</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th class="text-left">Codigo :</th>
                        <td>C-000{{$data2->id_user}}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Nombres:</th>
                        <td>{{$data2->cliente}} {{$data2->apellidos}}</td>
                    </tr>
                </tbody>
            </table>

            <table>
                <thead >
                    <tr>
                        <th colspan="4">DETALLES DEL PEDIDO</th>
                    </tr>
                </thead>
                <thead >
                    <tr>
                    <th class="text-left">#</th>
                    <th class="text-left">Producto</th>
                    <th class="text-left">Tipo</th>
                    <th class="text-left">Precio</th>
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

              <table>
                <thead>
                    <tr>
                        <th colspan="2">DETALLES DE RESERVA</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <th class="text-left">Estado ecónomico</th>
                        <td>
                            @if ($data2->paid=='si')
                                <strong class="text-success">CANCELADA</strong>
                            @else
                                <strong class="text-danger">PENDIENTE POR PAGAR</strong>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="text-left">Total</th>
                        <td>S/. {{$data2->total}}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Restaurante</th>
                        <td>{{$data2->name}}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Dirección</th>
                        <td>{{$data2->address}}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Personas</th>
                        <td>{{$data2->n_people}}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Fecha</th>
                        <td>{{$data2->date}}</td>
                    </tr>
                    <tr>
                        <th class="text-left">Hora</th>
                        <td>{{$data2->hour}}</td>
                    </tr>
                </tbody>
            </table>

            <div class="page-break"></div>

            <table >
                <thead >
                    <tr><th class="bg-plomo">CODIGO QR</th></tr>
                </thead>
            </table>

            <table>
                <tr>
                    </td>
                        <center>
                            <img src="data:image/png;base64, {{ base64_encode(\QrCode::format('png')->size(300)->margin(0)->generate($data2->id.",".$data2->created_at.",".$data2->name)) }} ">
                        </center>
                    </td>
                </tr>
            </table>

</body>

</html>
