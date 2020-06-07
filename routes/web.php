<?php

include ('web-admin.php');
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
    return view('welcome');
});

Route::view('/','home', ['nombre'=>'Jairo Peña Fuentes'])->name('home');

Route::view('inicio','inicio', ['nombre'=>'Jairo Peña Fuentes'])->name('inicio');
//Route::resource('sedes', 'SedesController')->names('sedes')->parameters(['sedes'  =>  'sedes'])->middleware('role:1|2');
Route::resource('formulario', 'FormularioController')->names('formulario')->parameters(['formulario'  =>  'formulario']);//->middleware('role:1|2');

Route::resource('users', 'UsersController')->names('users')->parameters(['users'  =>  'users']);//->middleware('role:1|2');
Route::resource('usuarios', 'UsuariosController')->names('usuarios')->parameters(['usuarios'  =>  'usuarios']);//->middleware('role:1|2');
Route::get('usuarios/editar/{usuarios}', 'UsuariosController@editar')->name('usuarios.editar');


Route::post('revisar', 'RevisarController@verificar')->name('revisar');


Route::get('losusuarios', function(){
    return datatables()
    ->query(DB::table('users'))
    ->addColumn('action', function ($registro) {
        return 
        '
        <a href="'.route('users.show', $registro->n_idusuario).'"> Ver</a>

       ';
    })
    ->toJson();

});

Auth::routes();