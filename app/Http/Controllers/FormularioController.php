<?php

namespace App\Http\Controllers;
use App\User;
use App\Entidades\Formulario;
use App\Entidades\Sedes;
use Validator;
use Illuminate\Http\Request;
use Session;
//Importanto las validaciones
use App\Http\Requests\SaveFormularioRequest;

class FormularioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
      
       if(!Session::has('idUsuario')){

         return route()->redirec('home');

       } 
       $key = Session::get('idUsuario');
       $usuarioesta=User::where('t_documento','=',$key)->first();
       //var_dump($key);
      return view('formulario.index', 
        [
            'formulario'=> Formulario::orderBy('n_idusuario','ASC')->paginate(10)
        ]);  
    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!Session::has('idUsuario')){

            return route()->redirec('home');
   
          } 
          $key = Session::get('idUsuario');

          $usuarioesta=User::where('n_idusuario','=',$key)->first();

          
          $viculoconu=$usuarioesta->vinculou->t_vinculo;
          $sedes= Sedes::all();
        //$project = Project::findOrFail($id);
         return view('formulario.create',[
            'formulario' => new Formulario,
            'n_idusuario'=>$key,
            'usuarioesta'=>$usuarioesta,
        'sedes'=>$sedes,
        'viculoconu'=>$viculoconu

          ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store2()
    {
       
       //dd(request()->all());
        $validator=Validator::make(request()->all(),$this->rules(),$this->messages());

       
     
        if($validator->fails()){
          //dd("Fallo"); 
           return   redirect()->back()->withErrors( $validator->errors());
        }

        $formulario= new Formulario(request()->all());        
        $formulario->t_texto=request('t_texto');
        $formulario->id_usuario=Session::get('idUsiario');
        dd(formulario);
        $formularo->save();

        Session::forget('idUsuario');
        Session::put('id_formulario',$formulario->n_idformulario);
        //Formulario::create($validator); //solo envia los que esten validados por CreateProjectRequest
        return redirect()->route('home')->with('status','La sede fue creado con éxito');
    }



    public function store3()
    {
      request()->validate([
            'n_idsede'=>"required"
           
      ]);
      return "Datos Validados";

    }



    public function store(SaveFormularioRequest $request)
    {
      Sedes::create($request->validated()); //solo envia los que esten validados por CreateProjectRequest
      return redirect()->route('home')->with('status','La sede fue creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function rules()
    {
        return [
            'n_idusuario' => 'required',
            'n_idsede' => 'required',
            't_consentimiento' => 'required',
            't_irahoy' => 'required',
            't_sitios' => 'sometimes',
            't_actividades' => 'sometimes',
            't_presentadofiebre' => 'required',
            't_diasfiebre' => 'sometimes|integer|min:0|max:200',
            't_dolorgarganta' => 'required',
            't_malestargeneral' => 'required',
            't_secresioncongestionnasal' => 'required',
            't_dificultadrespirar' => 'required',
            't_tosseca' => 'required',
            't_contactopersonasinfectadas' => 'required',            
            'd_ultimocontacto' => 'sometimes'


           

        ];
    }



    private function messages(){

        return [
            'n_idusuario.required' => "No ha selecionado la persona",
            //'t_nombres.min' => "El Nombre del Docente debe tener el menos 3 caracteres",
            //'t_nombres.max' => "El Nombre del  Docente debe tener máximo 100 caracteres",
            't_consentimiento.required' => "No has dado el consentimiento",
            'n_idsede.required' => "No has seleccionado la sede",
            't_irahoy.required' => "Debe responder si ira hoy a la Universidad",
            't_presentadofiebre.required' => "No has respondido si presento fiebre",
            't_dolorgarganta.required' => "No respondió a la pregunta sobre el dolor de garganta",
            't_malestargeneral.required' => "No has respondido sobre el malestar general",
            't_secresioncongestionnasal.required' => "No has respondido acerca de la Cosgentión Nasal",
            't_dificultadrespirar.required' => "No has Respondido acerca de la dificultad al respirar",
            't_tosseca.required' => "No has Respondido acerca de la tos seca",
            't_contactopersonasinfectadas.required' => "No has Respondido acerca de la cercanía con personas infectadas"
         ];
    }
    
}
