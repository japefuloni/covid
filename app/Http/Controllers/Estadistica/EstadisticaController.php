<?php

namespace App\Http\Controllers\Estadistica;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
/**
 * Javier Mantilla. javier.mantillap@upb.edu.co
 * 2020-06
 */
class EstadisticaController extends Controller
{

    public function __construct(){
        $this->middleware('auth');            
    }

    public function index(){   
        $objetos=['lista'=>null];         
        return view('estadistica.estadistica',$objetos);
    }

    public function getDatosGraficaFiebreAjax()
    {
        $fecha_desde='1900-12-31';
        if(request('fecha_desde')!=null){
            $fecha_desde=request('fecha_desde');
        }
        $fecha_hasta='1900-12-31';
        if(request('fecha_hasta')!=null){
            $fecha_hasta=request('fecha_hasta');
        }
        $sqlInterno="SELECT c.t_nombre ciudad, IFNULL(SUM(CASE WHEN f.t_presentadofiebre='SI' THEN 1 ELSE 0 END ),0)  AS si
            ,IFNULL(SUM(CASE WHEN f.t_presentadofiebre='NO' THEN 1 ELSE 0 END ),0)  AS no
            FROM formulario f inner join sedes s on (f.n_idsede=s.n_idsede) INNER JOIN ciudades c on (s.n_idciudad=c.n_id)
            WHERE f.t_activo='SI'
            AND DATE(f.created_at)>=:fecha_desde
            AND DATE(f.created_at)<=:fecha_hasta ";

        if(request('todas')==null){
            $sqlInterno.=" AND s.n_idciudad=".auth()->user()->n_idciudad; 
        }    
        $sqlInterno.=" GROUP BY c.t_nombre,f.t_presentadofiebre ";


        $sql="SELECT t.ciudad,sum(t.si) as si,sum(t.no) as no
              FROM (".$sqlInterno.") t
              GROUP BY t.ciudad ";
        
        //dd($sql);        
        $query = DB::select($sql,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);
        //return  json_encode($query);
        return response()->json($query);
    }

    public function getDatosGraficaSecrecionAjax()
    {
        $fecha_desde='1900-12-31';
        if(request('fecha_desde')!=null){ $fecha_desde=request('fecha_desde'); }
        $fecha_hasta='1900-12-31';
        if(request('fecha_hasta')!=null){ $fecha_hasta=request('fecha_hasta'); }

        $sqlInterno="SELECT c.t_nombre ciudad, IFNULL(SUM(CASE WHEN f.t_secresioncongestionnasal='SI' THEN 1 ELSE 0 END ),0)  AS si
            ,IFNULL(SUM(CASE WHEN f.t_secresioncongestionnasal='NO' THEN 1 ELSE 0 END ),0)  AS no
            FROM formulario f inner join sedes s on (f.n_idsede=s.n_idsede) INNER JOIN ciudades c on (s.n_idciudad=c.n_id)
            WHERE f.t_activo='SI' AND DATE(f.created_at)>=:fecha_desde AND DATE(f.created_at)<=:fecha_hasta ";

        if(request('todas')==null){
            $sqlInterno.=" AND s.n_idciudad=".auth()->user()->n_idciudad; 
        }    
        $sqlInterno.=" GROUP BY c.t_nombre,f.t_secresioncongestionnasal ";

        $sql="SELECT t.ciudad,sum(t.si) as si,sum(t.no) as no FROM (".$sqlInterno.") t GROUP BY t.ciudad ";                
        $query = DB::select($sql,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);        
        return response()->json($query);
    }

    public function getDatosGraficaViajeAjax()
    {
        $fecha_desde='1900-12-31';
        if(request('fecha_desde')!=null){ $fecha_desde=request('fecha_desde'); }
        $fecha_hasta='1900-12-31';
        if(request('fecha_hasta')!=null){ $fecha_hasta=request('fecha_hasta'); }

        $sqlInterno="SELECT c.t_nombre ciudad, IFNULL(SUM(CASE WHEN f.t_realizoviaje='SI' THEN 1 ELSE 0 END ),0)  AS si
            ,IFNULL(SUM(CASE WHEN f.t_realizoviaje='NO' THEN 1 ELSE 0 END ),0)  AS no
            FROM formulario f inner join sedes s on (f.n_idsede=s.n_idsede) INNER JOIN ciudades c on (s.n_idciudad=c.n_id)
            WHERE f.t_activo='SI' AND DATE(f.created_at)>=:fecha_desde AND DATE(f.created_at)<=:fecha_hasta ";

        if(request('todas')==null){
            $sqlInterno.=" AND s.n_idciudad=".auth()->user()->n_idciudad; 
        }    
        $sqlInterno.=" GROUP BY c.t_nombre,f.t_realizoviaje ";

        $sql="SELECT t.ciudad,sum(t.si) as si,sum(t.no) as no FROM (".$sqlInterno.") t GROUP BY t.ciudad ";                
        $query = DB::select($sql,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);        
        return response()->json($query);
    }

    public function getDatosGraficaGargantaAjax()
    {
        $fecha_desde='1900-12-31';
        if(request('fecha_desde')!=null){ $fecha_desde=request('fecha_desde'); }
        $fecha_hasta='1900-12-31';
        if(request('fecha_hasta')!=null){ $fecha_hasta=request('fecha_hasta'); }

        $sqlInterno="SELECT c.t_nombre ciudad, IFNULL(SUM(CASE WHEN f.t_dolorgarganta='SI' THEN 1 ELSE 0 END ),0)  AS si
            ,IFNULL(SUM(CASE WHEN f.t_dolorgarganta='NO' THEN 1 ELSE 0 END ),0)  AS no
            FROM formulario f inner join sedes s on (f.n_idsede=s.n_idsede) INNER JOIN ciudades c on (s.n_idciudad=c.n_id)
            WHERE f.t_activo='SI' AND DATE(f.created_at)>=:fecha_desde AND DATE(f.created_at)<=:fecha_hasta ";

        if(request('todas')==null){
            $sqlInterno.=" AND s.n_idciudad=".auth()->user()->n_idciudad; 
        }    
        $sqlInterno.=" GROUP BY c.t_nombre,f.t_dolorgarganta ";

        $sql="SELECT t.ciudad,sum(t.si) as si,sum(t.no) as no FROM (".$sqlInterno.") t GROUP BY t.ciudad ";                
        $query = DB::select($sql,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);        
        return response()->json($query);
    }

    public function getDatosGraficaMalestarAjax()
    {
        $fecha_desde='1900-12-31';
        if(request('fecha_desde')!=null){ $fecha_desde=request('fecha_desde'); }
        $fecha_hasta='1900-12-31';
        if(request('fecha_hasta')!=null){ $fecha_hasta=request('fecha_hasta'); }

        $sqlInterno="SELECT c.t_nombre ciudad, IFNULL(SUM(CASE WHEN f.t_malestargeneral='SI' THEN 1 ELSE 0 END ),0)  AS si
            ,IFNULL(SUM(CASE WHEN f.t_malestargeneral='NO' THEN 1 ELSE 0 END ),0)  AS no
            FROM formulario f inner join sedes s on (f.n_idsede=s.n_idsede) INNER JOIN ciudades c on (s.n_idciudad=c.n_id)
            WHERE f.t_activo='SI' AND DATE(f.created_at)>=:fecha_desde AND DATE(f.created_at)<=:fecha_hasta ";

        if(request('todas')==null){
            $sqlInterno.=" AND s.n_idciudad=".auth()->user()->n_idciudad; 
        }    
        $sqlInterno.=" GROUP BY c.t_nombre,f.t_malestargeneral ";

        $sql="SELECT t.ciudad,sum(t.si) as si,sum(t.no) as no FROM (".$sqlInterno.") t GROUP BY t.ciudad ";                
        $query = DB::select($sql,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);        
        return response()->json($query);
    }

    public function getDatosGraficaRepirarAjax()
    {
        $fecha_desde='1900-12-31';
        if(request('fecha_desde')!=null){ $fecha_desde=request('fecha_desde'); }
        $fecha_hasta='1900-12-31';
        if(request('fecha_hasta')!=null){ $fecha_hasta=request('fecha_hasta'); }

        $sqlInterno="SELECT c.t_nombre ciudad, IFNULL(SUM(CASE WHEN f.t_dificultadrespirar='SI' THEN 1 ELSE 0 END ),0)  AS si
            ,IFNULL(SUM(CASE WHEN f.t_dificultadrespirar='NO' THEN 1 ELSE 0 END ),0)  AS no
            FROM formulario f inner join sedes s on (f.n_idsede=s.n_idsede) INNER JOIN ciudades c on (s.n_idciudad=c.n_id)
            WHERE f.t_activo='SI' AND DATE(f.created_at)>=:fecha_desde AND DATE(f.created_at)<=:fecha_hasta ";

        if(request('todas')==null){
            $sqlInterno.=" AND s.n_idciudad=".auth()->user()->n_idciudad; 
        }    
        $sqlInterno.=" GROUP BY c.t_nombre,f.t_dificultadrespirar ";

        $sql="SELECT t.ciudad,sum(t.si) as si,sum(t.no) as no FROM (".$sqlInterno.") t GROUP BY t.ciudad ";                
        $query = DB::select($sql,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);        
        return response()->json($query);
    }

    public function getDatosGraficaTosAjax()
    {
        $fecha_desde='1900-12-31';
        if(request('fecha_desde')!=null){ $fecha_desde=request('fecha_desde'); }
        $fecha_hasta='1900-12-31';
        if(request('fecha_hasta')!=null){ $fecha_hasta=request('fecha_hasta'); }

        $sqlInterno="SELECT c.t_nombre ciudad, IFNULL(SUM(CASE WHEN f.t_tosseca='SI' THEN 1 ELSE 0 END ),0)  AS si
            ,IFNULL(SUM(CASE WHEN f.t_tosseca='NO' THEN 1 ELSE 0 END ),0)  AS no
            FROM formulario f inner join sedes s on (f.n_idsede=s.n_idsede) INNER JOIN ciudades c on (s.n_idciudad=c.n_id)
            WHERE f.t_activo='SI' AND DATE(f.created_at)>=:fecha_desde AND DATE(f.created_at)<=:fecha_hasta ";

        if(request('todas')==null){
            $sqlInterno.=" AND s.n_idciudad=".auth()->user()->n_idciudad; 
        }    
        $sqlInterno.=" GROUP BY c.t_nombre,f.t_tosseca ";

        $sql="SELECT t.ciudad,sum(t.si) as si,sum(t.no) as no FROM (".$sqlInterno.") t GROUP BY t.ciudad ";                
        $query = DB::select($sql,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);        
        return response()->json($query);
    }

    public function getDatosGraficaContactoAjax()
    {
        $fecha_desde='1900-12-31';
        if(request('fecha_desde')!=null){ $fecha_desde=request('fecha_desde'); }
        $fecha_hasta='1900-12-31';
        if(request('fecha_hasta')!=null){ $fecha_hasta=request('fecha_hasta'); }

        $sqlInterno="SELECT c.t_nombre ciudad, IFNULL(SUM(CASE WHEN f.t_contactopersonasinfectadas='SI' THEN 1 ELSE 0 END ),0)  AS si
            ,IFNULL(SUM(CASE WHEN f.t_contactopersonasinfectadas='NO' THEN 1 ELSE 0 END ),0)  AS no
            FROM formulario f inner join sedes s on (f.n_idsede=s.n_idsede) INNER JOIN ciudades c on (s.n_idciudad=c.n_id)
            WHERE f.t_activo='SI' AND DATE(f.created_at)>=:fecha_desde AND DATE(f.created_at)<=:fecha_hasta ";

        if(request('todas')==null){
            $sqlInterno.=" AND s.n_idciudad=".auth()->user()->n_idciudad; 
        }    
        $sqlInterno.=" GROUP BY c.t_nombre,f.t_contactopersonasinfectadas ";

        $sql="SELECT t.ciudad,sum(t.si) as si,sum(t.no) as no FROM (".$sqlInterno.") t GROUP BY t.ciudad ";                
        $query = DB::select($sql,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);        
        return response()->json($query);
    }

}
