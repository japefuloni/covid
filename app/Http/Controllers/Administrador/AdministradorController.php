<?php

namespace App\Http\Controllers\Administrador;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entidades\Administrador;
use Auth;
use Session;

class AdministradorController extends Controller
{
    private $administrador;
    
    public function __construct(){
        $this->middleware('auth');    
        $this->administrador= new Administrador();        
    }

    public function index(){
        if(Auth::id()!=1){
            redirect()->route('home');
        }
        if(Session::has('idAdministradorModificar')){
            $this->administrador=Administrador::find(Session::get('idAdministradorModificar'));            
        }else{
            $this->administrador=new Administrador();
            $this->administrador->b_habilitado =1;
        }
        return $this->mostrarView();        
    }
    private function mostrarView($messages='')
    {
        $objetos=['administrador'=>$this->administrador];         
        if($messages==''){
            return view('administrador.administrador',$objetos);
        }else{
            return view('administrador.administrador',$objetos)->withErrors($messages);
        }
    }


}
