<?php
// session_set_cookie_params(60, "/", "localhost", 0);
session_start();

function post($method){
  $encuesta = (isset($_SESSION['encuesta'])) ?
    $_SESSION['encuesta'] :
    [ 'si' => 0,
      'no' => 0,
      'total' => 0
    ];

  if ($method == "POST" && isset($_POST['voto'])){
    $voto = $_POST['voto'];

    if ($voto == "SI"){
      $encuesta['si']++;
    } else {
      $encuesta['no']++;
    }

    $encuesta['total']++;

    $_SESSION['encuesta'] = $encuesta;
  }
}


?>
