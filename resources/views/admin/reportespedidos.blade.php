@extends('layouts.app-a')

@section('scripts')
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

<script type="text/javascript">

    function filtrar()
    {
        fechaini = $('#fecini').val();
        fechafin = $('#fecfin').val();
        var finalUrl = {!! json_encode(url('/')) !!}+ "/admin/reportes-pedidos/get/" + $('#fecini').val() +"/" + $('#fecfin').val() +'/' +  false ;
        // console.log(finalUrl);
        $.get(finalUrl,function(data)
        {
            let filas = JSON.parse(data);
            let template  = ''
            filas.forEach( fila => {
                template +=
                `<tr>
                    <td><strong>${fila.date}</strong></td>
                    <td>${fila.hour}</td>
                    <td>${fila.restaurante}</td>
                    <td class='text-capitalize'>${fila.state}</td>
                    <td class='text-capitalize'>${fila.oca_special}</td>
                    <td>${fila.nombre_c} ${fila.apellido_c}</td>
                    <td>${fila.distrito}</td>
                </tr>`
                }
            );
            $('#contenttable').html(template);

            if(filas.length>0)
            {
                $('#btndescargarpdf').removeClass('d-none')
            }else
            {
                $('#btndescargarpdf').addClass('d-none')
            }

        });
    }

    function descargarPDF()
    {
        fechaini = $('#fecini').val();
        fechafin = $('#fecfin').val();
        var finalUrl = {!! json_encode(url('/')) !!}+ "/admin/reportes-pedidos/get/" + $('#fecini').val() +"/" + $('#fecfin').val() + '/' + true ;
        // console.log(finalUrl);
        // $.get(finalUrl,function(data){});
        $("#btndescargarpdf").attr("href", finalUrl)
        $("#btndescargarpdf").attr("target", "_blank")
        // $("#btndescargarpdf").click();
    }

</script>
@endsection

@section('content')
            <div class="row">
                <div class="col-12">
                    <strong class="navbar-brand p-0">Reporte pedidos personalizado</strong>
                    <hr>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-3">
                    <label for="fecini"><strong>Desde</strong></label>
                    <input type="date" class="form-control" value="{{date('Y-m-d')}}" name="fecini" id="fecini">
                </div>
                <div class="col-3">
                    <label for="fecini"><strong>Hasta</strong></label>
                    <input type="date" class="form-control" value="{{date('Y-m-d')}}" name="fecfin" id="fecfin">
                </div>
                <div class="col-2 mt-auto">
                    <button onclick="filtrar()" class="btn btn-primary">Filtrar</button>
                    <a onclick="descargarPDF();" href="" id="btndescargarpdf" class="btn btn-outline-success p-1 d-none">
                        <img src="https://img.icons8.com/color/48/000000/pdf-2.png" width="27">
                    </a>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-12">

                        <table class="table  table-hover ">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Hora</th>
                                        <th scope="col">Restaurante</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Ocasión Especial</th>
                                        <th scope="col">Cliente</th>
                                        <th scope="col">Distrito</th>
                                    </tr>
                                </thead>
                                <tbody id="contenttable">

                                </tbody>
                        </table>
                </div>
            </div>
 @endsection
