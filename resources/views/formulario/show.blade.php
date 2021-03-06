@extends('layout')

@section('title','Resultado Formulario | ' . $formulario->n_idformulario)
@section('titulopag','VERIFICACIÓN')
@section('elcontrolador','FORMULARIO')
@section('laaccion','Resultado')
    



@section('content')


@include('partials.session-status')


<?php 
$color="success";
$icono="checkmark";
$textautoriza="Está autorizado para ingresar a la universidad en la fecha <br><br>". date('Y-m-d') ;
$recomendaciones="<ul>
	<li>Para ingresar a la Universidad debes utilizar mascarilla (desechable o en tela). Si es desechables deben cambiarla diariamente, si es de tela el lavado debe ser diario.</li>
	<li> Llevar el cabello recogido</li>
	<li> Evite uso de accesorios, manillas, anillos, relojes, etc.</li>
	<li> Antes del ingreso a la Universidad, debes higienizar las manos.</li>
	<li> Si trabajas con otro compañero, deben estar trabajando a dos (2) metros de distancia.</li>
	<li> Debes estar lavándote las manos al menos cada tres horas</li>
	<li> Debes estar higienizándote las manos frecuentemente (gel antibacterial).</li>
	<li> No puedes compartir objetos y utensilios de trabajo.</li>
	<li> Si tu estancia es de todo el día debes llevar tu alimento y no lavar los recipientes en la Universidad.</li>
	<li> No puedes prender el aire acondicionado ni el ventilador. Excepto áreas que requieren una temperatura específica por los procesos que allí se ejecutan.</li>
	<li> No promover conversaciones entre compañeros que puedan disminuir el distanciamiento físico.</li>
	<li> Debes tener las ventanas abiertas para permitir una adecuada circulación del aire.</li>
	<li> Lavarse las manos antes de comer y después de ir al baño.</li>
</ul>";



if($formulario->n_semaforo=="2")
  {
    $color="warning";
    $icono="android-hand";
    $textautoriza="Usted no tiene permitido el ingreso a la Universidad, de forma temporal, por favor avise a su jefe inmediato o al contacto en la Universidad hacia donde se dirigía<br><br>". date('Y-m-d');
    $recomendaciones="Si presenta sintomatología, no debe consultar al servicio de urgencias, sino que debe quedarse en casa, tener aislamiento, usar tapabocas, hacer lavado frecuente de manos y marcar los números telefónicos establecidos para esto, ciñéndonos a las directrices del Gobierno Nacional y la Organización Mundial de la Salud.";
  } 
if($formulario->n_semaforo=="3")
  {
    $color="danger";
    $icono="heart-broken";
    $textautoriza="Usted no tiene permitido el ingreso a la Universidad, de forma temporal, por favor avise a su jefe inmediato o al contacto de la Universidad hacia donde se dirigía<br><br>". date('Y-m-d');
    $recomendaciones="El dolor en el pecho y la dificultad para respirar son signos de alerta para la infección de COVID-19 y deben ser atendidos por un médico.<br>Acuda al servicio de urgencias de su EPS";
  }


?>



<div class="col-lg-12 col-12">
  <!-- small box -->
  <div class="small-box bg-{{$color}}">
    <div class="inner">
      <h3>{{$formulario->usuario->t_nombres}} <br>{{$formulario->usuario->t_apellidos}}</h3>
      <h4>{{$formulario->usuario->c_codtipo}}: {{$formulario->usuario->t_documento}} </h4>
<br>
      <p><h1><strong><?php echo $textautoriza; ?></strong></h1></p>

      <br>
    </div>
    <div class="icon">
      <i class="ion ion-{{$icono}}"></i>
    </div>
    <a href="#" class="small-box-footer"><i class="fas fa-calendar"></i>&nbsp;<h4>{{date('Y-m-d h:i:s a')}} </h4></a>
  </div>
</div>

<div class="visible-print text-center">
  {!! QrCode::size(300)->generate(Request::url()); !!}
{{-- <p>{{ Request::url() }}</p> --}}
</div>

<div class="card card-{{$color}}">
  <div class="card-header">
    <h4 class="card-title">
      <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" class="" aria-expanded="true">
        <strong>Recomendaciones</strong>
      </a>
    </h4>
  </div>
  <div id="collapseOne" class="panel-collapse in collapse show" style="">
    <div class="card-body">
      <?php echo $recomendaciones ?>
    </div>
  </div>
</div>
  

    

    
  


  


@endsection


