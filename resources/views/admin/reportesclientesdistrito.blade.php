@extends('layouts.app-a')

@section('scripts')
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

<script type="text/javascript">

    function filtrar()
    {
        distrito = $('#distrito').val();
        var finalUrl = {!! json_encode(url('/')) !!}+ "/admin/reportes-clientes/get/" + distrito + '/' + false ;
        // console.log(finalUrl);
        $.get(finalUrl,function(data)
        {
            let filas = JSON.parse(data);
            let template  = ''
            filas.forEach( fila => {
                template +=
                `<tr>
                    <td>${fila.name}</td>
                    <td>${fila.surname}</td>
                    <td>${fila.email}</td>
                    <td class='text-capitalize'>${fila.telephone}</td>
                    <td class='text-capitalize'>${fila.points}</td>
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
        distrito = $('#distrito').val();
        var finalUrl = {!! json_encode(url('/')) !!}+ "/admin/reportes-clientes/get/" + distrito + '/' + true ;
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
                    <strong class="navbar-brand p-0">Reporte clientes por distrito</strong>
                    <hr>
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-3">
                    <label for="type">Distrito</label>
                    <select class="form-control" name="district_id" id="distrito">
                        @foreach ($distritos as $distrito)
                            <option  value="{{$distrito->id}}" >{{$distrito->name}}</option>
                        @endforeach
                        <option  value="all" selected >Todos</option>

                    </select>
                </div>
                <div class="col-3 pt-1">
                    <button onclick="filtrar()" class="btn btn-primary mt-4">Filtrar</button>
                    <a onclick="descargarPDF();" href="" id="btndescargarpdf" class="btn btn-outline-success p-1 mt-4 ml-1 d-none">
                        <img src="https://img.icons8.com/color/48/000000/pdf-2.png" width="27">
                    </a>
                </div>
            </div>

            <div class="row mt-2">
                <div class="col-12">

                        <table class="table  table-hover ">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Nombres</th>
                                        <th scope="col">Apellidos</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Celular</th>
                                        <th scope="col">Puntos</th>
                                        <th scope="col">Distrito</th>
                                    </tr>
                                </thead>
                                <tbody id="contenttable">

                                </tbody>
                        </table>
                </div>
            </div>
 @endsection
