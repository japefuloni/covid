<?php

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

Route::resource('formulario', 'FormularioController')->names('formulario')->parameters(['formulario'  =>  'formulario']);//->middleware('role:1|2');
Route::post('revisar', 'RevisarController@verificar')->name('revisar');

Auth::routes();