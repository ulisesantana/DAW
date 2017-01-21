<?php
  session_start();

  if (isset($_SESSION['auth'])) {
    unset($_SESSION['auth']);
    setcookie(session_name(),'',time()-10,'/');
    session_destroy();
  }

  header("Location: login.php");
?>
