<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Entidades\Menus;
use Auth;
use App\Entidades\Sedes;
use App\Entidades\Vinculou;
use DB;


//Importanto las validaciones
use App\Http\Requests\SaveUserRequest;

class UsuariosController extends Controller
{
    
  
  public function __construct(){
   // $this->middleware('auth');
   // $this->middleware('role:1|2');
    
}

  
  
  /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
      
      return view('users.index', 
        [
            'users'=> User::orderBy('t_apellidos','ASC')->paginate(10)
        ]);  
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         //$project = Project::findOrFail($id);
         $sedes= Sedes::all();
         $vinculou= Vinculou::all();
         return view('users.create',[
           'users' => new User,
           'sedes'=>$sedes,
           'vinculous'=>$vinculou
         ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     
     */
    public function store(SaveUserRequest $request)
    {
      User::create($request->validated()); //solo envia los que esten validados por CreateUserRequest
      return redirect()->route('users.index')->with('status','La sede fue creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     
     */
    public function show(User $users)
    {
      
      return view('users.show', [
        'users' => $users
    ]);
    }

    public function editar($algo)
    {
      var_dump($algo);
      $users= User::all();
      return view('users.show', [
        'users' => $users
    ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     
     */
    
    public function edit(Users $users)
      {
        return view('users.edit',
        [
          'users'=>$users
        ]);
      }

    /**
     * Update the specified resource in storage.
     *
     
     */
    public function update(Users $users, SaveUserRequest $request)
      {

       
    $users->update($request->validated()); //solo envia los que esten validados por SaveSedeRequest
        return redirect()->route('users.show',$users)->with('status','La sede fue actualizada con éxito');


      }

    /**
     * Remove the specified resource from storage.
     *
     
     */
    public function destroy(Users $users)
    {
      $users->delete();
      return redirect()->route('users.index')->with('status','La Sede fue eliminada con éxito');;
    }


    public function getListaUsuarios()
    {
      return datatables()->query(DB::table('users'))
        ->addColumn('action', function ($registro) {
        return '<a href="'.route('users.show', $registro->n_idusuario).'"> Ver</a>';
    })
    ->toJson();
    }
}
