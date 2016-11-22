<?php
session_name('session'); // Nombre de la sesión a crear/continuar.Mismo nombre que la cookie a crear
session_start();

$brand = (isset($_SESSION['brand'])) ? $_SESSION['brand'] : null;
$fuel = (isset($_SESSION['fuel'])) ? $_SESSION['fuel'] : null;
$date = (isset($_SESSION['date'])) ? $_SESSION['date'] : null;
$email = (isset($_SESSION['email'])) ? $_SESSION['email'] : null;

function post($method, $form){
  if ($method == "POST"){
    switch ($form) {
      case 1:
        $_SESSION['brand'] = $_POST['brand'];
        header('Location: paso2.php');
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
        //Envía el email

        //Borra la sesión

        //Redirecciona
        header('Location: paso1.php');
        break;
      case 5:

        break;
      default:
        // ERROR
        break;
    }
  }
}
?>
