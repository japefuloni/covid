<?php
Route::get('/clear','ConfiguracionController@clear')->name('clear');

##logins
Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('/autenticar','Auth\LoginController@validarLogin')->name('login.validar');
Route::get('/autenticar','Auth\LoginController@irLogin');
//Route::get('logout','Auth\LoginController@logout')->name('logout');


#administradores
Route::get('/administrador/listar','Administrador\ListarAdministradorController@index')->name('administrador.listar')->middleware('auth');
Route::post('/administrador/listar','Administrador\ListarAdministradorController@seleccionar')->name('administrador.seleccionar')->middleware('auth');




Route::get('/estadisticas','Auth\LoginController@showLoginForm')->name('estadisticas');