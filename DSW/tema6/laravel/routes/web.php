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

/*
|-------------------------------------------------------------------------------
| RUTAS PARA EL EJERCICIO BÁSICO DE RUTAS
|-------------------------------------------------------------------------------
*/
Route::get('/alumnos/{nombre}', function ($nombre) {
  return view('ejercicioRutas/nombrealumno', ['nombre' => $nombre]);
});

Route::get('/asignaturas/{asignatura}', function ($asignatura) {
  return view('ejercicioRutas/nombreasignatura', ['asignatura' => $asignatura]);
});

Route::get('/notas/{asignatura}/{alumno}/{nota}', function ($asignatura, $alumno, $nota) {
  return view('ejercicioRutas/notas', ['asignatura' => $asignatura, 'alumno' => $alumno, 'nota' => $nota]);
});

/*
|-------------------------------------------------------------------------------
| RUTA EJERCICIO ORDENAR NÚMEROS
|-------------------------------------------------------------------------------
*/
Route::get('/numeros/{num1}/{num2}/{num3}', [ 'uses' => 'Numeros@getMayor'] );

/*
|-------------------------------------------------------------------------------
| RUTAS EJERCICIO FORMULARIOS & PALABRAS
|-------------------------------------------------------------------------------
*/
Route::get('/formularios/palabras', function () {
  return view('palabras/formularioPalabra');
});

Route::get('/convertir/mayusculas', [ 'uses' => 'Palabras@convertirMayusculas']  );
Route::get('/convertir/minusculas', [ 'uses' => 'Palabras@convertirMinusculas']  );

/*
|-------------------------------------------------------------------------------
| RUTAS PARA EJERCICIO FORMULARIO DE INCIDENCIAS
|-------------------------------------------------------------------------------
*/
Route::get('/incidencias',function(){
   return view('incidencias/formularioRegistrarIncidencia', ['mensaje' => ""]);
});

Route::get('/incidencias/insertar', ['uses' => 'Incidencias@insertarIncidencia']);

Route::get('/incidencias/listar', ['uses' => 'Incidencias@listarIncidencias']);

Route::get('/incidencias/buscar', ['uses' => 'Incidencias@buscarIncidencias']);

Route::get('/incidencias/eliminar', ['uses' => 'Incidencias@eliminarIncidencia']);

/*
|-------------------------------------------------------------------------------
| RUTAS PARA EJEMPLO DE SESIONES
|-------------------------------------------------------------------------------
*/
Route::get('ejemplo/sesiones', ['uses' => 'Sesion@inicioAplicacion']);
Route::post('ejemplo/sesiones/nombresSesion', ['uses' => 'Sesion@nombresSesion']);

/*
|-------------------------------------------------------------------------------
| RUTAS PARA EJERCICIO DE SESIONES
|-------------------------------------------------------------------------------
*/
Route::get('sesiones', ['uses' => 'Sesion@start']);
Route::get('sesiones/logout', ['uses' => 'Sesion@logout']);

Route::get('sesiones/profile', ['uses' => 'Sesion@profile']);
Route::post('sesiones/profile', ['uses' => 'Sesion@profile']);

/*
|-------------------------------------------------------------------------------
| RUTAS PARA EJERCICIO DE AGENDA (CRUD)
|-------------------------------------------------------------------------------
*/
Route::get('agenda/login', function(){
  return view('crud/login', ['mensaje' => '']);
});
Route::get('agenda/logout', ['uses' => 'Crud@logout']);
Route::post('agenda/login', ['uses' => 'Crud@login']);
Route::get('agenda', ['uses' => 'Crud@start']);
Route::post('agenda', ['uses' => 'Crud@app']);
