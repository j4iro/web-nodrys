@extends('layouts.app-r')

@section('content') 
<div class="container mt-3">
    <div class="row">

        @include('includes/slidebar')

        <div class="col-10">
            <div class="row">
                <div class="col-12">
                    <h3>Reportes Clientes</h3>
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