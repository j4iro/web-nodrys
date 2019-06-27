@extends('layouts.app')

@section('content')
<div class="container mt-2">

    <div class="row my-4">
        <div class="col-12 text-center">
            <img class="img-fluid" src="{{asset('svg/logo.svg')}}" width="80" alt="Nodrys">
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">{{ __('Verifica tu dirección de email') }}</div>
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{__('Se ha enviado un nuevo enlace de verificación a su dirección de correo electrónico.')}}
                        </div>
                    @endif

                    {{ __('Antes de continuar, consulte su correo electrónico para ver un enlace de verificación.') }}
                    {{ __('Si no recibió el correo electrónico') }},
                    <a href="{{ route('verification.resend') }}">
                        <strong>{{ __('haga clic aquí para solicitar otro')}}</strong>
                    </a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
