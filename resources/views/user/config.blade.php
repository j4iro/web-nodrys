@extends('layouts.app')

@section('content')

<div class="container mt-4 ">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if(session('message'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>¡Genial!</strong> Tus datos se han actualizado correctamente.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(session('error_password_no_coinciden'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>¡Opss!</strong> Las contraseñas no coinciden, vuelve a intentarlo.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="card shadow mb-5">
                    <div class="card-header text-center"><img class="mb-1 mr-1" src="https://img.icons8.com/ios-glyphs/24/000000/user.png" width="18" ><strong>Mi perfil</strong></div>

                    <div class="card-body">
                    <form method="POST" action="{{ route('user.update') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Nombres') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ Auth::user()->name }}" required autofocus>

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
                                    <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ Auth::user()->surname }}" required >

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
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ Auth::user()->email }}" required >

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
                                    <input id="telephone" type="number" class="form-control{{ $errors->has('telephone') ? ' is-invalid' : '' }}" name="telephone" value="{{ Auth::user()->telephone }}"  >

                                    @if ($errors->has('telephone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('telephone') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="telephone" class="col-md-4 col-form-label text-md-right">Distrito</label>

                                <div class="col-md-6">

                                    <select name="district_id" class="form-control">
                                        @foreach ($districts as $district)
                                            <option value="{{$district->id}}" @if(Auth::user()->district_id==$district->id) {{'selected'}} @endif>{{$district->name}}</option>
                                        @endforeach
                                    </select>

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
                                    <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ Auth::user()->address }}"  >

                                    @if ($errors->has('address'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label  class="col-md-4 col-form-label text-md-right">
                                    <strong style="cursor:pointer;" onclick="show_block_password();" class="text-primary">Cambiar contraseña</strong>
                                </label>
                            </div>

                            <div id="block_password" class="d-none border border-primary p-3 rounded mb-3">
                            <div class="form-group row">
                                <label for="newpassword" class="col-md-4 col-form-label text-md-right">Nueva contraseña</label>

                                <div class="col-md-6">
                                    <input id="newpassword" onkeyup="agregar_required_repeat_password();" type="text" class="form-control{{ $errors->has('newpassword') ? ' is-invalid' : '' }}" name="newpassword" >

                                    @if ($errors->has('newpassword'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('newpassword') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="repeatpassword" class="col-md-4 col-form-label text-md-right">Repita la contraseña</label>

                                <div class="col-md-6">
                                    <input id="repeatpassword" onkeyup="agregar_required_new_password();" type="password" class="form-control{{ $errors->has('repeatpassword') ? ' is-invalid' : '' }}" name="repeatpassword"  >

                                    @if ($errors->has('repeatpassword'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('repeatpassword') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            </div>

                            <div class="form-group row">
                                <label for="imagepath" class="col-md-4 col-form-label text-md-right">Foto</label>

                                <div class="col-md-6">
                                    <input id="imagepath" type="file" class="form-control-file {{ $errors->has('imagepath') ? ' is-invalid' : '' }}" name="image_path"   >

                                    @if ($errors->has('imagepath'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('imagepath') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row justify-content-center">
                                <div class="col-md-4">
                                    @include('includes.avatar')
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

    @include('includes/footer')

@endsection

@section('scripts')
     {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script>
        function agregar_required_repeat_password()
        {
            if(newpassword.value.length!=0)
            {
                repeatpassword.required=true;
            }
            else
            {
                repeatpassword.required=false;
            }
        }
        function agregar_required_new_password()
        {
            if(repeatpassword.value.length!=0)
            {
                newpassword.required=true;
            }
            else
            {
                newpassword.required=false;
            }
        }
        function show_block_password()
        {

            if (block_password.classList.contains('d-none'))
            {
                block_password.classList.remove('d-none');
            }
            else
            {
                block_password.classList.add('d-none');
            }
        }
    </script>
@endsection
