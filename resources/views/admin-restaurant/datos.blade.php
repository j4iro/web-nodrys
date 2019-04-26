@extends('layouts.app-r')

@section('content')

<div class="container-fluid mt-3">
        <div class="row ">

        @include('includes/slidebar')

            <div class="col-12 col-md-9 col-lg-10 mb-3">

                @if(session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>¡Genial!</strong> Tus datos se han actualizado correctamente.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card shadow">
                <div class="card-header"><strong>Configuración de mis datos</strong></div>

                    <div class="card-body">
                    <form method="POST" action="{{ route('adminRestaurant.update') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombre') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{$datos->name}}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Slogan') }}</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{$datos->slogan}}" required >

                                    @if ($errors->has('surname'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('surname') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Descripción') }}</label>

                                <div class="col-md-6">
                                    <textarea id="description" type="text" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" name="description"required rows="5" >{{$datos->description}}</textarea>

                                    @if ($errors->has('description'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('description') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{$datos->email_acceso}}" required >

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telephone" class="col-md-4 col-form-label text-md-right">Telefono - Celular</label>

                                <div class="col-md-6">
                                    <input id="telephone" type="number" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" value="{{$datos->telephone}}"  >

                                    @if ($errors->has('telephone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('telephone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">Dirección</label>

                                <div class="col-md-6">
                                <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{$datos->address}}"  >

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="points" class="col-md-4 col-form-label text-md-right">Puntos</label>

                                <div class="col-md-6">
                                <input id="points" type="number" class="form-control{{ $errors->has('points') ? ' is-invalid' : '' }}" name="points" value="{{$datos->points}}"  >

                                    @if ($errors->has('points'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('points') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="imagepath" class="col-md-4 col-form-label text-md-right">Foto</label>

                                <div class="col-md-6">
                                    <input id="imagepath" type="file" class="form-control-file {{ $errors->has('imagepath') ? ' is-invalid' : '' }}" name="image_path" >

                                    @if ($errors->has('imagepath'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('imagepath') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row justify-content-center">
                                <div class="col-md-4">
                                    <img class="img-thumbnail shadow" src="{{ route('restaurant.image',['filename'=>$datos->image]) }}" class="img-fluid" alt="Foto de {{$datos->name}} en Nodrys">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Guardar Cambios
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
