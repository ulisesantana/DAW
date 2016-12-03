<?php
  session_start();

  if (isset($_SESSION['usuario'])) {
    unset($_SESSION['usuario']);
    setcookie(session_name(),'',time()-10,'/');
    session_destroy();
  }

  header("Location: login.php");
?>
