@extends('layouts.app-r')

@section('scripts')
    <script type="text/javascript">

        //aqui el codigo js .... soy JS puro corazon

    </script>
@endsection

@section('content')
            <div class="row">
                <div class="col-12">
                    <strong class="navbar-brand p-0">Reportes de Clientes</strong>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <select name="" class="form-control" id="">
                        <option value="">Elija el Filtrado</option>
                        <option value="">Filtrado por Pedidos</option>
                    </select>
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary">Filtro</button>
                </div>
            </div>
 @endsection
