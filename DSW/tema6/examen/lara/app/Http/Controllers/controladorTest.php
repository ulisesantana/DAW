<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class controladorTest extends Controller
{
  public function mostrarTest (Request $req) {
    if ($this->checkSession($req)) {
      $usuario = $req->session()->get('session');
      $registros = DB::select('SELECT * FROM t_preguntas');
      $nota = DB::select('SELECT nota FROM t_usuarios WHERE usuario = ?',[$usuario]);
      $data = [
        'preguntas' => $registros,
        'usuario' => $req->session()->get('session'),
        'nota' => $nota[0]->nota
      ];
  	  return view('formularioTest', $data);
    } else{
      return redirect()->action('controladorTest@login');
    }
	}

  // FUNCIÓN PARA INICIAR SESIÓN
  public function login(Request $req){
    $pass = DB::select('SELECT clave FROM t_usuarios
                          WHERE usuario = ?', [$req->usuario]);
    if($req->clave == $pass[0]->clave){
      $req->session()->put('session', $req->usuario);
      return redirect()->action('controladorTest@mostrarTest');
    } else {
      return view('loginTest', ['mensaje' => 'Contraseña o usuario incorrectos']);
    }
  }

  // FUNCIÓN PARA CERRAR SESIÓN
  public function logout(Request $request){
    $request->session()->flush();
    return redirect('login');
  }

  // FUNCIÓN PARA COMPROBAR SI SE HA INICIADO SESIÓN
  private function checkSession($req){
    if ($req->session()->has('session')) {
      return true;
    } else {
      return false;
    }
  }

  public function corregirTest(Request $req){
    $usuario = $req->session()->get('session');
    $preguntas = DB::select('SELECT * FROM t_preguntas');
    $respuestas = [];
    for ($i=1; $i < 6; $i++) {
      $respuestas[] = $req->input('respuesta'.$i);
    }
    $i = 0;
    $aciertos = 0;
    foreach ($preguntas as $pregunta) {
      if ($pregunta->respuesta == $respuestas[$i]) $aciertos++;
      $i++;
    }
    $nota = ($aciertos/count($respuestas))*100;
    $porcentaje = $nota.'%';

    $data = [
      'aciertos' => $aciertos,
      'porcentaje' => $porcentaje,
    ];

    DB::update('UPDATE t_usuarios SET nota=?
                  WHERE usuario=?',[$nota,$usuario]);

    return view('resultadoTest', $data);
  }

}
