<?php
function login($user, $pass){
  libxml_use_internal_errors(true);
  $auth = false;
  $usuarios = simplexml_load_file("users.xml");

  foreach ($usuarios->Usuario as $db) {
    if( ($user == $db->user) && ($pass == $db->pass) ){
      $auth = true;
      break;
    }
  }

  return $auth; //boolean
}

function setSessionCookie(){
  // Establece cuándo se cerrará la sesión automáticamente
  // Al poner strtotime('now') + $time declaramos que la cookie se destruirá por
  // inactividad, ya que si recargamos la página se volverá a añadir.
  // session_set_cookie_params(strtotime('now') + $time, "/", "localhost", 0);
  session_set_cookie_params(time() + 3600, "/", "localhost", 0);
  session_name();
  session_start(); // Inicia la sesión si no existe o prosigue con ella
}
?>
