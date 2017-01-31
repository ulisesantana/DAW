<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class controladorPalabras extends Controller
{
    public function convertirAMayusculas(Request $request){
      $palabra = $request->palabra;
      $palabra = strtoupper($palabra);
      echo $palabra;
    }
}
