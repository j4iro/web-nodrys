@extends('layouts.app')
@section('title')
Inicia sesión en Nodrys
@endsection
@section('content')

<div class="container my-3">
    <div class="row">
        <div class="col-12 text-center">
            <img class="img-fluid" src="{{asset('svg/logo.svg')}}" width="80" alt="">
        </div>
    </div>
    <div class="row justify-content-center mt-4">
        <div class="col-sm-8 col-md-6 col-lg-4">
            <div class="card shadow p-lg-2">
                {{-- <div class="card-header">{{ __('Login') }}</div> --}}

                <div class="card-body text-center pb-0">
                    <h4 class="mb-4">Inicia Sesión</h4>


                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row d-flex justify-content-center">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail</label><br> --}}

                            <div class="col-md-12">
                                <input id="email" type="email" placeholder="E-Mail" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} form-control-lg" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row d-flex justify-content-center">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-right">Contraseña</label> --}}

                            <div class="col-md-12">
                                <input id="password" placeholder="Contraseña" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} form-control-lg" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row my-0">
                            <div class="col-md-12 text-center">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                            {{ __('Recordar Contraseña') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12 text-center">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('¿Has olvidado tu contraseña?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-primary btn-lg btn-block">
                                    {{ __('Ingresar') }}
                                </button>
                            </div>
                        </div>
                        o

                        <div class="form-group row">
                                <div class="col-md-12 text-center">
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="./register">
                                            {{ __('Registrate aquí') }}
                                        </a>
                                    @endif
                                </div>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
