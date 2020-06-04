<?php
Route::get('/clear','ConfiguracionController@clear')->name('clear');

##logins
Route::get('/login','Auth\LoginController@showLoginForm')->name('login');
//Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::post('login','Auth\LoginController@validarLogin')->name('login');
//Route::get('login','Auth\LoginController@irLogin');
//Route::post('logout','Auth\LoginController@logout')->name('logout');