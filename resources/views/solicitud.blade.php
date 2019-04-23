@extends('layouts.app')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if($resultado!='nada')
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{$resultado}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @else
                <div class="alert alert-info" role="alert">
                    <strong>¡Excelente Decisión!</strong> Para formar parte de la plataforma por favor complete el siguiente formulario, una vez la solicitud se envie, nos pondremos en contacto con usted por medio de <strong>E-mail</strong> o <strong>telefono</strong> para responderle su solicitud. Esto puede demorar <strong>24 horas</strong> aproximadamente. Gracias por su elección.
                </div>
            @endif



            <div class="card shadow">
                <div class="card-header">Solicitud</div>

                <div class="card-body">
                <form method="POST" action="{{ route('solicitud.save') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" placeholder="Nombre del restaurante" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="slogan" class="col-md-4 col-form-label text-md-right">{{ __('Slogan') }}</label>

                            <div class="col-md-6">
                                <input id="slogan" type="text" placeholder="Slogan del restaurante" class="form-control{{ $errors->has('slogan') ? ' is-invalid' : '' }}" name="slogan" required autofocus>

                                @if ($errors->has('slogan'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('slogan') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="text" placeholder="Describa su restaurante" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description" required autofocus>

                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Dirección') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" placeholder="Ejemplo: Jr Enrique Barrón 1038 - Santa Beatriz" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" required >

                                @if ($errors->has('address'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" placeholder="Email para contactarlo" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" required >

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telephone" class="col-md-4 col-form-label text-md-right">Celular</label>

                            <div class="col-md-6">
                                <input id="telephone" placeholder="Celular" type="number" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" >

                                @if ($errors->has('telephone'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telephone') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="points" class="col-md-4 col-form-label text-md-right">Puntos</label>

                            <div class="col-md-6">
                                <input id="points" type="number" placeholder="Cantidad de puntos por reserva" class="form-control{{ $errors->has('points') ? ' is-invalid' : '' }}" name="points" >

                                @if ($errors->has('points'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('points') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="district_id_name" class="col-md-4 col-form-label text-md-right">Distrito</label>

                            <div class="col-md-6">

                                <select class="form-control" name="district_id_name" id="type">
                                    @foreach ($distritos as $distrito)
                                        <option value="{{$distrito->id}}" @if(isset($restaurante->district_id) && $distrito->id==$restaurante->district_id) {{'selected'}} @endif >{{$distrito->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('district_id_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('district_id_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category_id_name" class="col-md-4 col-form-label text-md-right">Categoría</label>

                            <div class="col-md-6">

                                    <select class="form-control" name="category_id_name" id="type">
                                        @foreach ($categorias as $categoria)
                                            <option value="{{$categoria->id}}" @if(isset($restaurante->category_id) && $categoria->id==$restaurante->category_id) {{'selected'}} @endif>{{$categoria->name}}</option>
                                        @endforeach
                                    </select>

                                @if ($errors->has('category_id_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('category_id_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="image" class="col-md-4 col-form-label text-md-right">Foto</label>

                            <div class="col-md-6">
                                <input id="image" type="file" class="form-control-file {{ $errors->has('image') ? ' is-invalid' : '' }}" name="image"   >

                                @if ($errors->has('image'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Enviar solicitud
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
