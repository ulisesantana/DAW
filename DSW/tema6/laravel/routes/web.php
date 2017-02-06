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

// RUTAS PARA EL EJERCICIO DE RUTAS
Route::get('/alumnos/{nombre}', function ($nombre) {
  return view('ejercicioRutas/nombrealumno', ['nombre' => $nombre]);
});

Route::get('/asignaturas/{asignatura}', function ($asignatura) {
  return view('ejercicioRutas/nombreasignatura', ['asignatura' => $asignatura]);
});

Route::get('/notas/{asignatura}/{alumno}/{nota}', function ($asignatura, $alumno, $nota) {
  return view('ejercicioRutas/notas', ['asignatura' => $asignatura, 'alumno' => $alumno, 'nota' => $nota]);
});

Route::get('/formularios/palabras', function () {
    return view('formularioPalabra');
});

// RUTA EJERCICIO ORDENAR NÚMEROS
Route::get('/numeros/{num1}/{num2}/{num3}', [ 'uses' => 'Numeros@getMayor'] );

// Rutas para el ejercicio de formularios
Route::get('/convertir', [ 'uses' => 'controladorPalabras@convertir']  );
