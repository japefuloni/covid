<?php

use Illuminate\Http\Request;
use DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

  

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
