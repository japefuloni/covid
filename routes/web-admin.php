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
Route::get('/administrador/listar/nuevo','Administrador\ListarAdministradorController@envioNuevo')->name('administrador.listar.nuevo')->middleware('auth');
Route::get('/administrador/administrador','Administrador\AdministradorController@index')->name('administrador.mostrar')->middleware('auth');
Route::post('/administrador/administrador','Administrador\AdministradorController@envioGuardar')->name('administrador.guardar')->middleware('auth');
Route::get('/perfil','Administrador\PerfilController@showPerfil')->name('administrador.perfil')->middleware('auth');
Route::post('/perfil/actualizar','Administrador\PerfilController@envioGuardarPerfil')->name('perfil.guardar')->middleware('auth'); 



Route::get('/estadistica','Estadistica\EstadisticaController@index')->name('estadistica');
Route::get('/estadistica/fiebre/grafico/ajax','Estadistica\EstadisticaController@getDatosGraficaFiebreAjax')->name('estadistica.fiebre.grafico.ajax')->middleware('auth');
Route::get('/estadistica/secrecion/grafico/ajax','Estadistica\EstadisticaController@getDatosGraficaSecrecionAjax')->name('estadistica.secrecion.grafico.ajax')->middleware('auth');