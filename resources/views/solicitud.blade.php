@extends('layouts.app')

@section('scripts')
      <script type="text/javascript" src={{asset('js/validaciones.js') }} rel="stylesheet"></script>
@endsection
@section('title')
    Solicitud de registro para unirse a Nodrys
@endsection

@section('content')

<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">

            @if(session('resultado'))
                <div class="alert alert-success alert-dismissible fade show " role="alert">
                    <strong>{{session('resultado')}}</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @else
                <div class="alert alert-info shadow"  role="alert">
                    <strong>¡Excelente Decisión!</strong> Para formar parte de la plataforma por favor complete el siguiente formulario, una vez la solicitud se envie, nos pondremos en contacto con usted por medio de <strong>E-mail</strong> o <strong>teléfono</strong> para responderle su solicitud. Esto puede demorar <strong>24 horas</strong> aproximadamente. Gracias por su elección.
                </div>
            @endif

            <div class="card shadow">
                <div class="card-header">Solicitud</div>

                <div class="card-body">
                <form method="POST" action="{{ route('solicitud.save') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                <strong class="navbar-brand">Datos del restaurante</strong>
                                <hr>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="name_restaurant" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                            <div class="col-md-6">
                                <input id="name_restaurant" type="text" placeholder="Nombre del restaurante" class="form-control{{ $errors->has('name_restaurant') ? ' is-invalid' : '' }}" name="name_restaurant" required autofocus>

                                @if ($errors->has('name_restaurant'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name_restaurant') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="district_name" class="col-md-4 col-form-label text-md-right">Distrito</label>

                            <div class="col-md-6">
                                <select class="form-control" name="district_name" id="type" required>

                                    @foreach ($distritos as $distrito)
                                        <option value="{{$distrito->id}}" @if(isset($restaurante->district_id) && $distrito->id==$restaurante->district_id) {{'selected'}} @endif >{{$distrito->name}}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('district_name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('district_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                <strong class="navbar-brand">Datos del contacto</strong>
                                <hr>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="name_owner" class="col-md-4 col-form-label text-md-right">Nombre</label>

                            <div class="col-md-6">
                                <input id="name_owner" type="text" placeholder="Nombre del contacto" class="form-control{{ $errors->has('name_owner') ? ' is-invalid' : '' }}" name="name_owner" required >

                                @if ($errors->has('name_owner'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name_owner') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surname_owner" class="col-md-4 col-form-label text-md-right">Apellidos</label>

                            <div class="col-md-6">
                                <input id="surname_owner" type="text" placeholder="Apellidos del contacto" class="form-control{{ $errors->has('surname_owner') ? ' is-invalid' : '' }}" name="surname_owner" required >

                                @if ($errors->has('surname_owner'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname_owner') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email_owner" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email_owner" type="email_owner" placeholder="Email del contacto" class="form-control{{ $errors->has('email_owner') ? ' is-invalid' : '' }}" name="email_owner" required >

                                @if ($errors->has('email_owner'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email_owner') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="telephone_owner" class="col-md-4 col-form-label text-md-right">Telefono - Celular</label>

                            <div class="col-md-6">
                                <input id="telephone_owner" placeholder="Telefono o Celular" type="text" class="form-control{{ $errors->has('telephone_owner') ? ' is-invalid' : '' }}" name="telephone_owner" required>

                                @if ($errors->has('telephone_owner'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('telephone_owner') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">Enviar solicitud</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('includes/footer')

@endsection
