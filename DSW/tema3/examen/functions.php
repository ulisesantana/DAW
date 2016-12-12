<?php
// session_name('session'); // Nombre de la sesión a crear/continuar.Mismo nombre que la cookie a crear
// session_start();

$value = (isset($_SESSION['value'])) ? $_SESSION['value'] : null;

function colorCookie($color){
   setcookie('color', $color, time()+30, '/');
 }

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

// POST checklist
// if (strpos($seleccionados, (string)$i) !== false) {
//   $seleccionado = "checked";
// } else {
//   $seleccionado = "";
// }
// echo '<input type="checkbox" name="seleccionados[]" value="'.$i.'" '.$seleccionado.'>';
if (isset($_POST['seleccionados'])) {
  //print_r($_POST['seleccionados']);
  $seleccionados = $_POST['seleccionados'];
  $valor = "";
  // guarda todos los precios en una string y en una única cookie:
  foreach($seleccionados as $pos) {
    $valor .= "#".$pos;
  }
  setcookie("seleccionados", $valor, time() + 30*24*60*60, "/");
  // recargamos la web:
  header("Location: ".htmlspecialchars($_SERVER['PHP_SELF']));
}


function cookieSetted($name){
  $data = [];
  if (!isset($_COOKIE[$name])) { // Si no existe la cookie de sesión -> sesión caducada

  } else {

  }
  return $data;
}

function destroy(){
  $_SESSION = array();
  setcookie(session_name(),'',time()-3600,'/');
  session_destroy();
}


function post($method){
    if ($method == "POST"){

    }
}

function postSwitch($method, $form){
  if ($method == "POST"){
    switch ($form) {
      case 1:
        $_SESSION['brand'] = $_POST['brand']; //Setea la variable de sesión
        header('Location: paso2.php'); //Redirecciona al siguiente paso
        break;
      case 2:
        $_SESSION['fuel'] = $_POST['fuel'];
        header('Location: paso3.php');
        break;
      case 3:
        $_SESSION['date'] = $_POST['date'];
        header('Location: paso4.php');
        break;
      case 4:
        $_SESSION['email'] = $_POST['email'];
        header('Location: paso5.php');
        break;
      case 5:
        destroy();  //Borra la sesión
        header('Location: index.php');  //Envía al inicio con las sesión destruida

        break;
      default:
        // ERROR
        header('Location: index.php');
        break;
    }
  }
}


/*
 * $name = Nombre de la sesión
 * $time = Tiempo que le damos para caducar
 */
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
