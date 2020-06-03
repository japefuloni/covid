@extends('layout')
@section('title','Formulario COVID-19' )
@section('titulopag','VERIFICANDO DOCUMENTO')
@section('elcontrolador','Revisión')
@section('laaccion','Verificación')


@section('nombusuario', $nombrecompleto )



@section('content')


<?php 

//dd($contestohoy);
if ($errorenform=="Usuario No Existe")
  {
  ?>
  <h4>Usuario no Registrado. Por favor haga su proceso de Registro</h4><br>
  <a href="{{ route('register') }}" class="btn btn-warning">Registrarse</a>
  <?php
  }
else 
  {
  ?>   
  <h4>Bienvenido a la encuesta para...  <strong>{{$nombrecompleto}}</strong> </h4><br>
  <?php
  if ($contestohoy=="SI") echo '<h4>El d&iacute;a de Hoy ya contest&oacute; el formulario. Muchas gracias</h4><br>';
    else
    {
    ?>
    <h4>Por favor llene todos los campos del formulario</h4><br>
    <h4><p class="text-danger">Formulario</p></h4> 
    <?php 
    }
    ?>

   

<?php
}



?>


 
@endsection


