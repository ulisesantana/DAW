<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Palabras extends Controller
{
    public function convertirMayusculas(Request $request){
      $palabra = $request->palabra;
      $palabra = strtoupper($palabra);
      return view('palabras/resultado', [ 'mensaje' => $palabra] );
    }

    public function convertirMinusculas(Request $request){
      $palabra = $request->palabra;
      $palabra = strtolower($palabra);
      return view('palabras/resultado', [ 'mensaje' => $palabra] );
    }
}
