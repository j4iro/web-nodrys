@extends('layouts.app-r')

@section('content')


<div class="col-6 ">

    @if(session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>¡Genial!</strong> Tus datos se han guardado correctamente.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form action="{{route('admin-r.cuentaBancaria.save')}}" method="post">
        {{ csrf_field() }}
    <div class="card shadow">
    <div class="card-header"><strong>Configuración de mi cuenta bancaria</strong></div>

        <div class="card-body">
                <div class="row mt-2">
                        <div class="col-12">
                            <input type="checkbox" class="d-none" name="pagarcontarjeta" id="checkpagarcontarjeta">
                            <input type="text" placeholder="Número de tarjeta" class="form-control" name="num_card" value="{{ $card->num_card ?? '' }}" id="num_card" autofocus>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-12">
                            <input type="text" placeholder="Nombre en la tarjeta" class="form-control" value="{{ $card->owner ?? '' }}" name="owner" id="owner" >
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-8 ">
                            <select name="country" class="form-control" id="country">
                                <option value="" disabled selected>Pais</option>
                                <option value="per" @if(isset($card->country) && "per"==$card->country) {{'selected'}} @endif >Perú</option>
                                <option value="col" @if(isset($card->country) && "col"==$card->country) {{'selected'}} @endif >Colombia</option>
                                <option value="chi" @if(isset($card->country) && "chi"==$card->country) {{'selected'}} @endif >Chile</option>
                                <option value="ecu" @if(isset($card->country) && "ecu"==$card->country) {{'selected'}} @endif >Ecuador</option>
                                <option value="mex" @if(isset($card->country) && "mex"==$card->country) {{'selected'}} @endif >México</option>
                            </select>
                        </div>
                        <div class="col-4">
                            <input  placeholder="Código Postal" type="number" class="form-control" value="{{ $card->cod_postal ?? '' }}" name="cod_postal" id="cod_postal">
                        </div>
                    </div>

                    @if(isset($card->id))
                        <input type="hidden" name="action" value="editar">
                        <input type="hidden" name="id_card" value="{{ $card->id ?? '' }}">
                    @else
                        <input type="hidden" name="action" value="guardar">
                    @endif

                    <div class="row mt-4 ">
                        <div class="col-12">
                            <button type="submit" class="btn btn-danger btn-block ">Guardar Cambios</button>
                        </div>
                    </div>

        </div>

    </div>
    </div>
</div>

</form>
@endsection
