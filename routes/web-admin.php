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

/* Route::get('/usuario/usuario','Usuario\UsuarioController@showView')->name('usuario.mostrar')->middleware('auth');
Route::post('/usuario/usuario','Usuario\UsuarioController@envioGuardar')->name('usuario.guardar')->middleware('auth');
Route::get('/perfil','Usuario\PerfilController@showPerfil')->name('usuario.perfil')->middleware('auth');
Route::post('/perfil/actualizar','Usuario\PerfilController@envioGuardarPerfil')->name('perfil.guardar')->middleware('auth'); */





Route::get('/estadistica','Estadistica\EstadisticaController@index')->name('estadistica');