<?php

namespace App\Http\Controllers\Estadistica;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ConsultaFormularioExport;
use Validator;
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

    public function generarExcelFormularios()
    {
        $validator = Validator::make(request()->all(), [
            'fecha_desde' => 'required|date','fecha_hasta' => 'required|date',
        ]);
        if ($validator->fails()){
            $messages = $validator->messages();
            return view('estadistica.estadistica',['null'=>null,])->withErrors($messages);
        }
        $fecha_desde='1900-12-31';
        if(request('fecha_desde')!=null){ $fecha_desde=request('fecha_desde'); }
        $fecha_hasta='1900-12-31';
        if(request('fecha_hasta')!=null){ $fecha_hasta=request('fecha_hasta');}    

        $sql="SELECT f.n_idformulario,date(f.created_at) fecha  ,u.t_nombres ,u.t_apellidos,c.t_nombre,s.t_sede,f.t_consentimiento
        ,f.t_irahoy ,f.t_sitios,f.t_actividades,f.t_presentadofiebre,f.t_diasfiebre ,f.t_dolorgarganta
        ,f.t_malestargeneral,f.t_secresioncongestionnasal,f.t_dificultadrespirar,f.t_tosseca,f.t_contactopersonasinfectadas
        ,f.d_ultimocontacto,f.t_realizoviaje,f.created_at,f.updated_at
        from formulario f inner join users u on (f.n_idusuario=u.n_idusuario) INNER JOIN sedes s on (f.n_idsede=s.n_idsede) INNER JOIN ciudades c on (s.n_idciudad=c.n_id)
        where f.t_activo='SI'  AND DATE(f.created_at)>=:fecha_desde AND DATE(f.created_at)<=:fecha_hasta ";
        if(request('todas')==null){
            $sql.=" AND s.n_idciudad=".auth()->user()->n_idciudad; 
        }
        $registros = DB::select($sql,['fecha_desde' => $fecha_desde,'fecha_hasta' => $fecha_hasta]);
        //dd($registros);
        return Excel::download(new ConsultaFormularioExport($registros), 'CONSULTAS_FORMULARIOS.xlsx');
    }

}




/* public static function getServiciosConsulta($fechaDesde='1900-12-31',$fechaHasta='1900-12-31'){

    $sql="SELECT s.id,DATE_FORMAT(s.fecha,'%d/%m/%Y') fecha/*,
    s.fecha*/
           /*  ,(WEEKDAY(s.fecha) + 1) as num_dia
            ,DATE_FORMAT(s.fecha, '%W %d %M %Y') fecha_larga
            ,s.id_persona,CONCAT(p.nombre,' ',p.apellido) AS profesional
            ,i.direccion direccion_inmueble_servicio ,lzon.nombre zona_inmueble
            ,ltdoc.nombre tipo_identificacion
            ,c.identificacion
            ,CONCAT(COALESCE(c.nombre,''), ' ',COALESCE(c.apellido,'')) cliente
            ,c.direccion direccion_cliente,lzcli.nombre zona_cliente,ls.nombre tipo_servicio,la.nombre agenda
            ,lfre.nombre frecuencia,s.valor,lsop.nombre soporte_pago,id_soporte_servicio
            ,COALESCE(so.numero_soporte,s.documento_soporte) as documento_soporte
            ,s.fecha_pago,lp.nombre forma_pago,s.created_at
            /*,s.habilitado*/
           /*  ,u1.name registro,u2.name actualizo
            FROM servicios s inner join
                 personas p on (s.id_persona=p.id) inner join
                 clientes_inmueble i on (s.id_inmueble=i.id) inner join
                 clientes c on (i.id_cliente=c.id) inner join
                 listas_grupo ls on (s.id_tipo_servicio=ls.id) inner join
                 listas_grupo la on (s.id_estado_agenda=la.id) left join
                 listas_grupo lp on (s.id_forma_pago=lp.id) left join
                 listas_grupo lsop on (s.id_soporte=lsop.id) left join
                 soportes so on (s.id_soporte_servicio=so.id ) left join
                 listas_grupo lfre on (i.id_frecuencia=lfre.id) inner join
                 users u1 on (s.id_usuario=u1.id) inner join
                 users u2 on (s.id_usuario_update=u2.id) left join
                 listas_grupo lzon on (i.id_zona=lzon.id) left join
                 listas_grupo lzcli on (c.id_zona=lzcli.id) left join
                 listas_grupo ltdoc on (c.id_tipo_identificacion=ltdoc.id)
            where s.habilitado=1
            and s.fecha>=:fecha_desde
            and s.fecha<=:fecha_hasta
            order by fecha asc"; */

    /* $registros = DB::select($sql,['fecha_desde' => $fechaDesde,'fecha_hasta' => $fechaHasta]); 

    return $registros; */