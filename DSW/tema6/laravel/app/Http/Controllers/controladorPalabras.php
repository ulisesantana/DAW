<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controladorPalabras extends Controller
{
    public function convertir(Request $request){
      $palabra = $request->palabra;
      $palabra = strtoupper($palabra);
      return view('resultado', [ 'mensaje' => $palabra] );
    }
}
