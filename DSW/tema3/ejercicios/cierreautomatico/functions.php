<?php
session_name('session'); // Nombre de la sesión a crear/continuar.Mismo nombre que la cookie a crear
session_start();

$value = (isset($_SESSION['value'])) ? $_SESSION['value'] : null;

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
?>
