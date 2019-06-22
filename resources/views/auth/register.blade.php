@extends('layouts.app')

@section('scripts')

@endsection
@section('content')
    <script type="text/javascript" src={{asset('js/validaciones.js') }} rel="stylesheet"></script>
<div class="container">
    {{-- <div class="row">
        <div class="col-12 text-center">
            <img src="https://getbootstrap.com/docs/4.3/assets/brand/bootstrap-solid.svg" width="80" alt="">
        </div>
    </div> --}}
    <div class="row mt-4 justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header">{{ __('Registro') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- <div class="row">
                            <div class="col-12 text-center">
                                    <h4 class="mb-4">Inicia Sesión</h4>
                            </div>
                        </div> --}}
                             <div class="form-group row">
                                 <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('DNI') }}</label>
                                 <div class="col-md-6">
                                    <div class="input-group ">
                                      <input type="text" class="form-control" placeholder="Consultar a Reniec +18" id="dni" onkeypress="return validarNumero(event);" >
                                              <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button" id="btnbuscar">
                                                        <img id="ico" src="https://image.flaticon.com/icons/svg/116/116836.svg" width="20" height="20" alt="Lupa icono gratis" title="Lupa icono gratis">
                                                    </button>
                                              </div>
                                    </div>
                                 </div>
                            </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombres') }}</label>

                            <div class="col-md-6">
                                <input id="name"  onkeypress="return validarLetras(event);" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

                            <div class="col-md-6">
                                <input id="surname" onkeypress="return validarLetras(event);" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ old('surname') }}" required autofocus>

                                @if ($errors->has('surname'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Repita la contraseña') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right"></label>

                            <div class="col-md-6">
                                <label for="password-confirm"><a target="_new" href="{{asset('Términos y Condiciones de Uso.pdf') }}"> Al registratse acepta los Términos y uso de condiciones </a></label>
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Registrarme') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

var dd;
        $(document).ready(function(){
            $('#btnbuscar').click(function(){
                var dni=$('#dni').val();
                if (dni!='') {
                    $.ajax({
                        url:"{{route('respuestaDni')}}",
                        method:'GET',
                        beforeSend:function(){
                             document.getElementById('ico').src="images/gif/cargando.gif";
                        },

                        data:{dni:dni},
                        dataType:'json',
                        complete:function(data){
                           
                        },
                        success:function(data){
                            
                            console.log(data);
                            var obj=data.dataProcess;

                            if (obj!=0) {
                                  document.getElementById('ico').src="images/gif/ok.jpg";
                                $('#dni').val(obj.dni);
                                $('#name').val(obj.nombres);
                                $('#surname').val(obj.apellido_paterno+' '+obj.apellido_materno);
                               
                            

                            }
                            if(obj==0){
                                
                                document.getElementById('ico').src="images/gif/incorrecto.png";
                                alert('Error');
                             
                                $('#dni').val('');
                                $('#name').val(''); 
                                $('#surname').val('');
                                location.reload();
                            }
                        },
                        error:function(error_data){
                                alert(error_data);
                        }
                    });
                }else{
                    alert('Escribe el dni');
                    $('#dni').focus();
                }

            });
        });
   

</script>
@endsection
