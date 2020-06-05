@extends('layout')
@section('title','Formulario COVID-19' )
@section('titulopag','USUARIOS ADMINISTRADORES')
@section('elcontrolador','Menu')
@section('laaccion','Administradores')
@section('content')
<div class="col-md-6">
    <form class="formulario" role="form" id="frmAdministrador" data-toggle="validator" method="post" action="{{ route('administrador.guardar') }}"
        data-bv-feedbackicons-valid="glyphicon glyphicon-ok" 
        data-bv-feedbackicons-invalid="glyphicon glyphicon-remove"
        data-bv-feedbackicons-validating="glyphicon glyphicon-refresh" >    
        {{ csrf_field() }}
    <div class="card card-secondary">
        <div class="card-header">
            <h3 class="card-title">Datos Básicos</h3>   
            <label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbspID:</label>&nbsp&nbsp<label class="btn bg-yellow">{{$administrador->n_id}}</label>
            <input id="n_idadministrador" name="n_idadministrador" type="hidden" value="{{$administrador->n_id}}" />           
        </div>    
        <div class="card-body">
            <div class="form-group">
                <label for="t_nombrecompleto">Nombre Completo *</label>
                <input type="text" class="form-control" id="t_nombrecompleto" name="t_nombrecompleto" placeholder="Digite el nombre completo"
                value="{{ $administrador->t_nombrecompleto }}" required>
            </div>
            <div class="form-group {{ $errors->has('t_email') ? 'has-error' : '' }}">
                <label for="email-d">Email</label>
                @if ($administrador->n_id!=null)
                    <input type="email"  class="form-control" name="email-d" id="email-d" value="{{$administrador->t_email}}" disabled />
                    <input type="hidden"  value="{{$administrador->t_email}}"  class="form-control" name="t_email" id="t_email" />
                @else
                    <input type="email"  class="form-control" name="t_email" id="t_email" placeholder="Ingrese Correo electronico"
                    value="{{$administrador->t_email}}"  required>
                @endif                            
            </div>
            <div class="form-group has-feedback is-invalid{{ $errors->has('t_idinstrumento') ? 'has-error' : '' }}"  id="grupoInstrumento" >
                <label for="n_idciudad" class="control-label">Ciudad *</label>                
                <div class="row">
                    <div class="col-7">
                        <select class="form-control" name="n_idciudad" id="n_idciudad" required>
                            <option value="">Seleccione ...</option>
                            @foreach($listaCiudades as $ciudad)
                                <option value="{{$ciudad->n_id}}"{{ ($administrador->n_idciudad==$ciudad->n_id) ? 'selected=selected' : '' }}>
                                 {{$ciudad->t_nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group ">
                <label for="b_todas">Nacional</label>
                <input name="b_todas" id="b_todas" type="checkbox" {{ $administrador->b_todas==1 ? 'checked' : '' }} value="1" class="flat-red" > Todas Ciudades
            </div>
            <div class="form-group {{ $errors->has('t_login') ? 'has-error' : '' }}">                
                <label for="t_login" class="control-label">Login *</label>           
                <div class="row">
                   <div class="col-5">
                        <input type="text" class="form-control" maxlength="20" id="t_login" name="t_login"  placeholder="Usuario" value="{{ $administrador->t_login }}" required>
                   </div>
                </div>
            </div>
            <div class="form-group has-feedback {{ $errors->has('password') ? 'has-error' : '' }}">
                <label for="password">Pasword</label>
                <div class="input-group mb-3">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Digite el Password">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="glyphicon glyphicon-lock"></i></span>
                    </div>
                </div>    
            </div>
            <div class="form-group has-feedback">
                <label for="password_confirmation">Confirmar Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirmar password">
                <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
            </div>
            
            
            
            <div class="form-group ">
                <label for="b_habilitado">Estado</label>
                <input name="b_habilitado" id="b_habilitado" type="checkbox" {{ $administrador->b_habilitado==1 ? 'checked' : '' }} value="1" class="flat-red" > Activo
            </div>
            @if ($administrador->n_id!=null)
            <div class="form-group ">
                <p>Ultima actualización : {{ $administrador->dt_updated_at}}</p>
            </div>   
            @endif
        </div>
        <div class="card-footer">
            <a href="{{ route('administrador.listar') }}" class="btn btn btn-default" role="button">Volver</a>
            <button type="submit" class="btn btn-primary pull-right">Guardar</button>
        </div>      
    </div> 
    </form>
</div>
@endsection
@section('script-custom')
<script>
    $(function () {      
      $("#menuAdministrador" ).addClass("active" );                  
    });
  </script>
@endsection
