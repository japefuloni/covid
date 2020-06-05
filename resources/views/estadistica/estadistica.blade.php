@extends('layout')
@section('title','Formulario COVID-19' )
@section('titulopag','ESTADISTICAS')
@section('elcontrolador','Menu')
@section('laaccion','Estadistica')
@section('content')
<div class="col-md-6">
    Hola mundo
</div>
@endsection
@section('script-custom')
<script>
    $(function () {      
      $("#menuEstadistica" ).addClass("active" );      
      
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
