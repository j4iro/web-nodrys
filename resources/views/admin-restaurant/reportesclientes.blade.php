@extends('layouts.app-r')

@section('content')
<div class="container-fluid mt-3">
    <div class="row">

        @include('includes/slidebar')

        <div class="col-12 col-md-9 col-lg-18 mb-3">
            <div class="row">
                <div class="col-12">
                    <strong class="navbar-brand p-0">Reportes de Clientes</strong>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <select name="" class="form-control" id="">
                        <option value=""></option>
                    </select>
                </div>
                <div class="col-2">
                    <button type="submit" class="btn btn-primary">Filtro</button>
                </div>
            </div>
        </div>

    </div>

</div>
 @endsection
