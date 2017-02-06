<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


Route::get('/',function(){  // Inicio de la aplicación; p.e.: http://www.larawebapp.com
   return view('formularioRegistrarIncidencia', ['mensaje' => ""]);
});

Route::get('/incidencias/insertar', ['uses' => 'controladorIncidencias@insertarIncidencia']);
// URL: http://localhost:8000/incidencias/insertar

Route::get('/incidencias/listar', ['uses' => 'controladorIncidencias@listarIncidencias']);
// URL: http://localhost:8000/incidencias/listar

Route::get('/incidencias/buscar', ['uses' => 'controladorIncidencias@buscarIncidencias']);
// URL: http://localhost:8000/incidencias/buscar

Route::get('/incidencias/eliminar', ['uses' => 'controladorIncidencias@eliminarIncidencia']);
// URL: http://localhost:8000/incidencias/eliminar



Route::get('/controlador', ['uses' => 'controlador@mostrarTodo']);  // URL: http://localhost:8000/controlador 

Route::get('/controlador/cliente/{nombre}',['uses' => 'controlador@mostrarCliente']); // URL: http://localhost:8000/controlador/cliente/<cualquiervalor>

Route::get('/web',['uses' => 'controlador@mostrarTodo']); // URL: http://localhost:8000/web

Route::get('/ventas/{cliente}', function ($cliente) {  //  URL: http://localhost:8000/ventas/nombreCliente
	return view("fichacliente", ['cliente' => $cliente]);
});




Route::get('/controlador', ['uses' => 'controlador@mostrarTodo']);  // URL: http://localhost:8000/controlador 

Route::get('/controlador/cliente/{nombre}',['uses' => 'controlador@mostrarCliente']); // URL: http://localhost:8000/controlador/cliente/<cualquiervalor>

Route::get('/web',['uses' => 'controlador@mostrarTodo']); // URL: http://localhost:8000/web

Route::get('/ventas/{cliente}', function ($cliente) {  //  URL: http://localhost:8000/ventas/nombreCliente
	return view("fichacliente", ['cliente' => $cliente]);
});
