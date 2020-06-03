<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Input;


use App\Entidades\Formulario;
use App\User;


class RevisarController extends Controller
{
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verificar()
    {
        $key = Input::get('t_documento');
        $docentesall= Formulario::all();
        $usuarioesta=User::where('t_documento','=',$key)->first();
        $usuariohoy="";
        $nombrecompleto="";
        $idusuario="";
        
        $errorenform="";

        $contestohoy="NO";
        $puedeingresar="SI";

        $fechahoy= date('Y-m-d 00:00:00');
        //dd($fechahoy);

        if (!is_null($usuarioesta)){
          $nombrecompleto=$usuarioesta->t_nombres." ".$usuarioesta->t_apellidos;
          $idusuario=$usuarioesta->n_idusuario;
          $formhoy=Formulario::where([
              ['n_idusuario', '=', $idusuario],
              ['created_at', '>', $fechahoy],
          ])->first();

          

          if (!is_null($formhoy)){
            $contestohoy="SI";

            $t_presentadofiebre=$formhoy->t_presentadofiebre;


            ///hola mundo
           
            

          };


        //dd($usuarioesta);
        }
        else
        {
            $errorenform="Usuario No Existe";
        }

        
      //var_dump($docentesall);
      
      
      


      return view('revisar.verificar',[
        'nombrecompleto'=>$nombrecompleto,
        'idusuario'=>$idusuario,
        'docentesall' => $docentesall,
        'errorenform'=>$errorenform,
        'contestohoy'=>$contestohoy
      ])->with('status','El Docente Nuevo fue creado con éxito');;
    }
}
