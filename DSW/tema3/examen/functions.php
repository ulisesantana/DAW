<?php
function setSessionCookie($time){
   // Establece cuándo se cerrará la sesión automáticamente
   session_set_cookie_params($time, "/", "localhost", 0);
   session_start(); // Inicia la sesión si no existe o prosigue con ella
 }

function post($method, $form){
  if ($method == "POST"){
    switch ($form) {
      case 1: //formulario que viene de login.php
        if($_POST['usuario'] == 'root' || $_POST['usuario'] == 'alumno'){
          if(isset($_POST['sesion']) && $_POST['sesion'] == 'abierto'){
            setSessionCookie(3600); //Le damos un año de tiempo a la cookie de sesión
          } else{
            setSessionCookie(31);
            // Con 30 segundos no funcionaba, pero con 31 sí. Sinceramente,
            // después de esto me iré al monte a comer nueces y descubrirme
            // a mí mismo.
          }
          $_SESSION['data'] = [
            'nombre' => $_POST['usuario'],
            'idioma' => $_POST['idioma'],
            'tamano' => $_POST['tamano'],
            'sesion' => ($_POST['sesion'] == 'abierto') ? 'SI' : 'NO',
            'hora' => gmdate("H:i:s", $_SERVER['REQUEST_TIME'])
          ];
          header('Location: principal.php'); //Redirecciona al siguiente paso
        } else{
          header('Location: login.php');
        }
        break;
      case 2: // Formulario que viene de principal.php
        if(isset($_POST['idioma'])){
          $_SESSION['data']['idioma'] = $_POST['idioma'];
        } elseif(isset($_POST['tamano'])){
          $_SESSION['data']['tamano'] = $_POST['tamano'];
        }
        header('Location: principal.php');
        break;
      default:
        // ERROR
        header('Location: login.php');
        break;
    }
  }
}
?>
