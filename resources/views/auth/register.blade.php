@extends('layout')


@section('title','Registrar Usuario')
@section('titulopag','REGISTRO')
@section('elcontrolador','REGISTRO')
@section('laaccion','Registro de Usuario')
    



@section('content')
@include('partials.session-status')
@include('partials.validation-errors')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3>Datos Obligatorios </h3>
                    @if ($errors->any())
                    <ul>
                     @foreach ($errors->all() as $item)
                 
                     <li>{{ $item }}</li>
                         
                     @endforeach
                 </ul> 
                 @endif
                
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="t_apellidos" class="col-md-4 col-form-label text-md-right">{{ __('Apellidos') }}</label>

                            <div class="col-md-6">
                                <input id="t_apellidos" type="text" class="form-control @error('t_apellidos') is-invalid @enderror" name="t_apellidos" value="{{ old('t_apellidos') }}" required autocomplete="apellidos" autofocus>

                                @error('t_apellidos')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="t_nombres" class="col-md-4 col-form-label text-md-right">{{ __('Nombres') }}</label>

                            <div class="col-md-6">
                                <input id="t_nombres" type="text" class="form-control @error('t_nombres') is-invalid @enderror" name="t_nombres" value="{{ old('t_nombres') }}" required autocomplete="nombres" >

                                @error('t_nombres')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="t_documento" class="col-md-4 col-form-label text-md-right">{{ __('Documento') }}</label>

                            <div class="col-md-6">
                                <input id="t_documento" type="text" class="form-control @error('t_documento') is-invalid @enderror" name="t_documento" value="{{ old('t_documento') }}" required autocomplete="documento" >

                                @error('t_nombres')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="t_idsigaa" class="col-md-4 col-form-label text-md-right">{{ __('IDSIGAA') }}</label>

                            <div class="col-md-6">
                                <input id="t_idsigaa" type="text" class="form-control @error('t_idsigaa') is-invalid @enderror" name="t_idsigaa" value="{{ old('t_idsigaa') }}"  >

                                @error('t_idsigaa')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="t_email" type="email" class="form-control @error('t_email') is-invalid @enderror" name="t_email" value="{{ old('t_email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="t_clave" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="t_clave" type="password" class="form-control @error('t_clave') is-invalid @enderror" name="t_clave" value="{{ old('t_clave') }}" required autocomplete="new-password">

                                @error('t_clave')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="t_clave-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="t_clave-confirm" type="password" class="form-control" name="t_clave_confirmation" value="{{ old('t_clave_confirmation') }}" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                                <a href="{{ route('home') }}" class="btn btn-warning">Volver</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
