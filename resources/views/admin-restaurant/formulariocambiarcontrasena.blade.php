@extends('layouts.app-r')

@section('content')
<form action="{{route('adminRestaurant.guardarcontrasena')}}" method="post">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if(session('errors')!="")
                        <div class="alert alert-success">                                                         <strong>
                                        {{session('errors')}}
                                </strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="container mt-8 card border-primary">
                <div class="row">
                    <div class="col-12 text-center mt-2">
                        <h2>Cambiar la Contraseña</h2>
                    </div>
                </div>
                <div class="form-group row mt-2">
                    <label for="actual_p" class="col-md-4 col-form-label text-md-right">Contraseña Actual</label>

                    <div class="col-md-6">
                        <input id="actual_p"  type="text"  class="form-control" name="actual_p" >
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nueva_p" class="col-md-4 col-form-label text-md-right">Nueva contraseña</label>

                    <div class="col-md-6">
                        <input id="nueva_p"  type="text" class="form-control"  name="nueva_p" >
                    </div>
                </div>



                    <div class="form-group row">
                        <label for="repite_p" class="col-md-4 col-form-label text-md-right">Repita la contraseña</label>

                        <div class="col-md-6">
                            <input id="repite_p"  type="text" class="form-control" name="repite_p"  >


                        </div>
                    </div>
                    <div class="form-group row text-center">
                        <div class="col-6 text-center">
                            <input type="submit" class="btn btn-primary" value="Cambiar">
                        </div>
                    </div>

                </div>
</form>

@endsection
