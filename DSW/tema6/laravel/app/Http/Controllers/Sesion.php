<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Sesion extends Controller
{
  /*
  |-------------------------------------------------------------------------------
  | FUNCIONES PARA EJERCICIO DE SESIONES
  |-------------------------------------------------------------------------------
  */
  var $noConfig = [ //Inicializamos el array para que no pete la vista
    'name' => null,
    'bg' => null,
    'lang' => null,
    'date' => null
  ];

  public function start(Request $request){
    // Si existe la variable de sesión la cargamos
    if ($request->session()->has('config')) {
      $config = $request->session()->get('config');
    } else {
      $config = $this->noConfig;
    }

    return view('sesiones/inicio', ['config' => $config]);
  }

  public function profile(Request $request){
    // Si existe la variable de sesión la cargamos
    if ($request->session()->has('config') && !$request->isMethod('post')) {
      $config = $request->session()->get('config');
    } elseif ($request->isMethod('post')) {
      $config = [
        'name' => $request->name,
        'bg' => $request->bg,
        'lang' => $request->lang,
        'date' => date("j/n/Y")
      ];
      $request->session()->put('config', $config);
    } else {
      return view('sesiones/inicio', ['config' => $this->noConfig]);
    }

    return view('sesiones/profile', ['config' => $config]);
  }

  public function logout(Request $request){
    $request->session()->flush();

    return view('sesiones/inicio', ['config' => $this->noConfig]);
  }


  /*
  |-------------------------------------------------------------------------------
  | FUNCIONES PARA EJEMPLO DE SESIONES
  |-------------------------------------------------------------------------------
  */
  public function inicioAplicacion (Request $request) {
    // si existe la variable de sesión  la recuperamos para mostrarla
    // al cargar la página:
    if ($request->session()->has('arrayNombresSesion')) {
      $arrayNombresSesion = $request->session()->get('arrayNombresSesion');
    } else {
      $arrayNombresSesion = array();
    }
    // Mostrar la vista con el formulario y el listado de nombres guardadados en la sesión
    return view('sesiones/nombresSesion',
    ['mensaje' => "", 'arrayNombresSesion' => $arrayNombresSesion]);
  }

  public function nombresSesion (Request $request) {
    $mensaje = "";
    if (isset($request->guardar)) {
      if (empty($request->nombre)) {
        $mensaje = "Debe indicar un nombre a añadir";
      } else {
        $nuevoNombre = $request->nombre;
        // Si existe la variable de sesión (el array) --> la recuperamos:
        if ($request->session()->has('arrayNombresSesion'))
        $arrayNombresSesion = $request->session()->get('arrayNombresSesion');
        else
        $arrayNombresSesion = array();
        if (!in_array($nuevoNombre, $arrayNombresSesion)){
          array_push($arrayNombresSesion, $nuevoNombre);
          sort($arrayNombresSesion);
          $request->session()->put('arrayNombresSesion', $arrayNombresSesion);
        } else {
          $mensaje = "El nombre indicado ya se encuentra almacenado";
        }
      }
    }
    if (isset($request->borrar)) {
      $request->session()->flush();
      $arrayNombresSesion = array();
    }
    return view('sesiones/nombresSesion',
    ['mensaje' => $mensaje, 'arrayNombresSesion' => $arrayNombresSesion]);
  }

}
