<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Numeros extends Controller
{
    public function getMayor($num1, $num2, $num3){
      $numeros = [$num1, $num2, $num3];

      $sonNumeros = true;
      $patron = '/\d+\.?\d+/';

      foreach ($numeros as $numero) {
        if (!preg_match($patron,$numero)) {
          $sonNumeros = false;
          break;
        }
      }

      if($sonNumeros){
        usort($numeros, function($a, $b){
          if ($a == $b) {
            return 0;
          }
          return ($a > $b) ? -1 : 1;
        });

        return view('numeros/numeros', ['numero' => $numeros[0]]);
      } else {
        return view('error', ['error' => 'No todos los parámetros son números']);
      }
    }
}
