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


Route::get('/', ['uses' => 'controladorTest@mostrarTest']);
Route::get('/login', function(){
  return view('loginTest', ['mensaje' => '']);
});
Route::get('/logout', ['uses' => 'controladorTest@logout']);
Route::post('/login', ['uses' => 'controladorTest@login']);
Route::get('/test', ['uses' => 'controladorTest@corregirTest']);
