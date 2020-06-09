@extends('layout')
@section('title','Reporte Personas Críticas Por Periodo')
@section('titulopag','REPORTE')
@section('elcontrolador','REPORTES')
@section('laaccion','Personas Críticas (Sospechosas) por Periodo')
@section('content')
@include('partials.session-status')

<div class="card">
    <div class="card-header">
         <form method="post" id="search-form" name="search-form" data-toggle="validator" class="formulario"   role="form">
          @csrf
        <div class="row">
          <div class="col-sm">
            <label id="ld_ultimocontacto">
                Ingrese la Fecha Inicial del periodo
            </label>
            <input size=200 class="form-control col-md-10" type="date" id="fecha_desde" name="fecha_desde" value="{{ old('fecha_desde') }}"><br>
          </div>
          <div class="col-sm">
            <label id="ld_ultimocontacto">
            Ingrese la Fecha Final del Periodo
            </label>
            <input size=40 class="form-control col-md-10" type="date" id="fecha_hasta" name="fecha_hasta" value="{{ old('fechahasta') }}"><br>
          </div>
          <div class="col-sm">
            <button class="btn btn-info" type="submit">Consultar</button>
          </div>
        </div>
      </form>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
            <table id="example1" class="table table-bordered table-striped dataTable" role="grid" aria-describedby="example1_info">
                    <thead>
                    <tr role="row">                        
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Activo: activate to sort column ascending" style="width: 50px;">Activo</th>
                        <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Jefe: activate to sort column ascending" style="width: 320px;">Fecha y Hora de Presentación</th>
                  
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Usuario: activate to sort column ascending" style="width: 176px;">Usuario</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Resultado: activate to sort column ascending" style="width: 176px;">Resultado</th>
                       <th class="sorting" tabindex="0" aria-controls="example1" rowspan="1" colspan="1" aria-label="Ingreso: activate to sort column ascending" style="width: 176px;">Ingresó</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
            </table>                 
    </div>
    <!-- /.card-body -->
  </div>

@endsection

@section('script-custom')
<script>
  var otable=null;
  $(document).ready(function() {
      $("#menuInactivar" ).addClass("active" );
      otable=$('#example1').DataTable({
        'paging' : false,'ordering': false,
          "searching": false,"processing": true,"serverSide": true,"info": false,
          "language": { "url": "/bower_components/datatables.net/locale/Spanish.json"},
          "ajax": {
                  url: '{!! route('reporteador1'); !!}',
                  data: function (d) {
                      d.fecha_desde = $('input[name=fecha_desde]').val();
                      d.fecha_hasta = $('input[name=fecha_hasta]').val();
                  }
              },
          "columns": [{data: 'activo' },{data: 'updated_at' },{data: 'nombrec' },{data: 'semaforo' },{data: 'ingreso' }],
          "language": { "url": "/plugins/datatables/locale/Spanish.json",},
          dom: 'lfBrtip',
          "order": [[ 0, "desc" ]],		
          buttons: [
            {
                 extend: 'copy',
                 exportOptions: {
                 columns: [  0, 1, 2, 3, 4 ] //Your Colume value those you want
                     }
                   },
                  {
                 extend: 'print',
                 exportOptions: {
                 columns: [ 0, 1, 2, 3, 4 ] //Your Colume value those you want
                     }
                   },
                   {
                    extend: 'excel',
                    exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ] //Your Colume value those you want
                   }
                 },
                 {
                    extend: 'pdf',
                    exportOptions: {
                    columns: [  0 , 1, 2, 3, 4 ] //Your Colume value those you want
                   }
                 },
               ],
          aLengthMenu: [
          [10, 50, 100, 200, -1],
          [10, 50, 100, 200, "All"]
      ],
      iDisplayLength: 10,
          
      } );

      $('#search-form').on('submit', function(e) {
            e.preventDefault();
            console.log('Entro');
            otable.draw();   
                
       });

     });
  </script>
@endsection

