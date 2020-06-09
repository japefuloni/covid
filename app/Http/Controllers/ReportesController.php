<?php

namespace App\Http\Controllers;
use App\User;
use App\Entidades\Formulario;
use App\Entidades\Sedes;
use Validator;

use Illuminate\Http\Request;

//Importanto las validaciones
use App\Http\Requests\SaveFormularioRequest;
use DB;
use Auth;
use DataTables;

class ReportesController extends Controller
{
    public function index(){


        return view('reportes.index', 
        [
            
        ]);  




    }



    public function getReporte1Formularios()
    {
      $id_ciudad=auth()->user()->n_idciudad;
      $fechahoy=date('Y-m-d 00:00:00');

      $fecha_desde='1900-12-31';
      
      if(request('fecha_desde')!=null){
          $fecha_desde=request('fecha_desde');
      }
      $fecha_hasta='1900-12-31';
      if(request('fecha_hasta')!=null){
          $fecha_hasta=request('fecha_hasta');
      }


        $elselect= "SELECT * ";
        $elselect .= " ,CONCAT('(',us.c_codtipo,' ',us.t_documento,') ',us.t_nombres,' ',us.t_apellidos) as nombrec, fo.t_activo as activo";
        $elselect .= " FROM covidform.formulario fo, users us, sedes se";
        $elselect .= " where fo.created_at >=:fecha_desde";
        $elselect .= " and fo.created_at <= :fecha_hasta";
        $elselect .= " and fo.n_semaforo>1";
        $elselect .= " and us.n_idusuario=fo.n_idusuario";
        $elselect .= " and se.n_idsede= fo.n_idsede";
        $elselect .= " and se.n_idciudad>0";

        $query = DB::select($elselect,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);

        //dd($elselect);
      
        //return datatables()->of($query)
        return Datatables::of($query)
        /*
        ->addColumn('action', function ($registro) {
            if ($registro->activo=="SI")return '<a href="'.route('formulario.updateinac', $registro->n_idformulario).'"> Inactivar</a>';
            if ($registro->activo=="NO")return 'DESACTIVADO';

        
    })
    */
    ->addColumn('semaforo', function ($registro) {
        if ($registro->n_semaforo=="1")return '<strong class="text-success">Verde</strong>';
        if ($registro->n_semaforo=="2")return '<strong class="text-warning">Amarillo</strong>';
        if ($registro->n_semaforo=="3")return '<strong class="text-danger">Rojo</strong>';
    })
    ->addColumn('ingreso', function ($registro) {
    if ($registro->n_semaforo=="1")return '<strong class="text-success">SI</strong>';
    if ($registro->n_semaforo=="2")return '<strong class="text-danger">NO</strong>';
    if ($registro->n_semaforo=="3")return '<strong class="text-danger">NO</strong>';
    })
    ->rawColumns(['action','semaforo','ingreso'])
    ->toJson();
    }
}
