@extends('layout')
@section('title','Formulario COVID-19' )
@section('titulopag','USUARIOS ADMINISTRADORES')
@section('elcontrolador','Menu')
@section('laaccion','Administradores')
@section('content')
<div class="col-md-6">
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
            <div class="form-group {{ $errors->has('t_login') ? 'has-error' : '' }}">                
                <label for="t_login" class="control-label">Login *</label>           
                <div class="row">
                   <div class="col-5">
                        <input type="text" class="form-control" maxlength="20" id="t_login" name="t_login"  placeholder="Usuario" value="{{ $administrador->t_login }}" required>
                   </div>
                </div>
            </div>   
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary pull-right">Guardar</button>
        </div>      
    </div> 
</div>
@endsection
@section('script-custom')
<script>
    $(function () {      
      $("#menuAdministrador" ).addClass("active" );      
      
      /* $('#example1').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": true,
        "ordering": false,
        "info": true,
        "autoWidth": false,
        "responsive": true,
        "language": { "url": "/plugins/datatables/locale/Spanish.json",},
        "pageLength": 10,
        "lengthMenu": [[10, 25, 50,100, -1], [10, 25, 50,100, "All"]],
      }); */
    });
  </script>
@endsection
