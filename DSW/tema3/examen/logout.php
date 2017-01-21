<?php
  session_start();

  if (isset($_SESSION['data'])) {
    unset($_SESSION['data']);
    setcookie(session_name(),'',time()-10,'/');
    session_destroy();
  }

  header("Location: login.php");
?>
