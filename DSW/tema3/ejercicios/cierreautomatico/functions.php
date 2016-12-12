<?php
function destroy(){
  $_SESSION = array();
  setcookie(session_name(),'',time()-3600,'/');
  session_destroy();
  header('Location: index.php');
}

function cookieSetted($name, $time){
  $data = [];
  if (!isset($_COOKIE[$name])) { // Si no existe la cookie de sesión -> sesión caducada
    $data['finSesion'] = true;
    $data['msg'] = "<p style=\"color:red; font-family:verdana;\">
                      Su sesión ha caducado después de $time seg de inactividad
                    </p>
                    <a href=\"index.php\">
                      << VOLVER
                    </a>";
  } else {
    $data['finSesion'] = false;
    $data['msg']="<p style=\"color:blue;font-family:verdana;\">
                Sesión activa.Programada para finalizar a los $time seg de incatividad
              </p>";
  }
  return $data;
}

function setSessionCookie($name, $time){
  // Establece cuándo se cerrará la sesión automáticamente
  // Al poner strtotime('now') + $time declaramos que la cookie se destruirá por
  // inactividad, ya que si recargamos la página se volverá a añadir.
  // session_set_cookie_params(strtotime('now') + $time, "/", "localhost", 0);
  session_set_cookie_params($time, "/", "localhost", 0);
  session_name($name);
  session_start(); // Inicia la sesión si no existe o prosigue con ella
}
?>
