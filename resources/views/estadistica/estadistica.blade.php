@extends('layout')
@section('title','Formulario COVID-19' )
@section('titulopag','ESTADISTICAS')
@section('elcontrolador','Menu')
@section('laaccion','Estadistica')
@section('content')
<script src="/plugins/jquery-ui/jquery-ui.min.js"></script>
<link rel="stylesheet" href="/plugins/jquery-ui/jquery-ui.min.css">
<!-- datepicker -->
<script src="/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="/plugins/bootstrap-datepicker/js/locales/bootstrap-datepicker.es.js"></script>
<link rel="stylesheet" href="/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">

<div class="col-md-4">
  <form method="post" id="search-form" name="search-form" data-toggle="validator" class="formulario"         role="form">
  <div class="card card-secondary">
    <div class="card-body">
        <div class="form-group fecha-desde" >
            <label for="fecha_desde" >Fecha Desde *</label>
            <div class="input-group date " style="width:200px" >
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-calendar-alt open-fecha-desde"></i></span>
                </div>
                <input type="text" value="" maxlength="10" size="10" class="form-control pull-right" id="fecha_desde" name="fecha_desde" placeholder="yyyy-mm-dd" required>
            </div>
        </div>
        <div class="form-group fecha-hasta" >
            <label for="fecha_hasta" >Fecha Hasta *</label>
            <div class="input-group date" style="width:200px" >
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="far fa-calendar-alt open-fecha-hasta "></i></span>
                </div>
                <input type="text" value="" size="10"  maxlength="10" class="form-control pull-right" id="fecha_hasta" name="fecha_hasta" placeholder="yyyy-mm-dd" required>
            </div>
        </div>
        <div class="form-group" >
            <input name="excel" id="excel"  type="checkbox" value="1" class="flat-red pull-right" > Generar Excel
        </div>
    </div>
    <div class="card-footer">
        {{-- <button id="btnGenerarExcel" name="btnGenerarExcel" type="button" class="btn btn-success">Generar Excel</button> --}}
        <button id="btnConsultar" type="submit" class="btn btn-info pull-right">Consultar</button>
    </div>
  </div> 
  </form>      
</div>
<div class="row">
  <section class="col-lg-3 connectedSortable">
    <div class="">
        <div class="card card-info">
            <div class="card-header with-border">
              <h3 class="card-title">{{ Config::get('pregunta.fiebre') }}</h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                  <i class="fas fa-minus"></i></button>                
              </div>
            </div>
            <div class="card-body">
              <div id="graph-container" class="chart">
                <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
            <!-- /.box-body -->
          </div>
    </div>
</div>
@endsection
@section('script-custom')
<script>
    $(function () {   
      var today = new Date(); var dd = today.getDate(); var mm = today.getMonth()+1;
      var yyyy = today.getFullYear();
      if(dd<10){ dd='0'+dd; }
      if(mm<10){mm='0'+mm;}
      today = yyyy+'-'+mm+'-'+dd;
      $("#fecha_desde").val(today);
      $("#fecha_hasta").val(today);   
      $("#menuEstadistica" ).addClass("active" );   
      $('#fecha_desde').datepicker({ autoclose: true,format:'yyyy-mm-dd',defaultViewDate:'today',todayHighlight:true,todayBtn:true
                ,enableOnReadonly:true,language:'es',
        }).on('changeDate', function(e) {});
        $('#fecha_hasta').datepicker({ autoclose: true,format:'yyyy-mm-dd',defaultViewDate:'today',todayHighlight:true,todayBtn:true
                ,enableOnReadonly:true,language:'es',
        }).on('changeDate', function(e) {});
        $('.open-fecha-desde').click(function(event){ event.preventDefault(); $('#fecha_desde').focus();});
        $('.open-fecha-hasta').click(function(event){ event.preventDefault(); $('#fecha_hasta').focus();});         

        $('#search-form').on('submit', function(e) {
               e.preventDefault();                
               oTable.draw();
              /* if($('input:checkbox[name=excel]:checked').val()!=1){
                  oTable.draw();
                  //cargarGrafica();
                  $('#btnConsultar').attr("disabled", false);
                  e.preventDefault();
              }else{
                    //$('form[name=search-form]').attr('action','{! ! route('reporte.financiero.uno.generar.excel'); !!}');
                    //$("#search-form").unbind('submit').submit();
              } */
                
        });
        $('#excel').on('ifChecked', function(event){
             $("#btnConsultar").text("Generar Excel");
        });
       $('#excel').on('ifUnchecked', function(event){
            $("#btnConsultar").text("Consultar");
            $('#btnConsultar').removeAttr("disabled");
            document.location.href="{!! route('estadistica'); !!}";
        });
        if($('input[name=fecha_desde]').val()!='' && $('input[name=fecha_hasta]').val()!=''){
            //cargarGrafica();
        }else{
            //grafica( ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'],[0, 0, 0, 0, 0, 0]);
        }
      
    });
  </script>
@endsection
