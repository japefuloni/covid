<?php

namespace App\Http\Controllers\Estadistica;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EstadisticaController extends Controller
{

    public function __construct(){
        $this->middleware('auth');            
    }

    public function index(){   
        $objetos=['lista'=>null];         
        return view('estadistica.estadistica',$objetos);
    }
}
