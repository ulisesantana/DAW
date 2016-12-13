<?php
session_name('session'); // Nombre de la sesión a continuar
session_start();

$_SESSION = array();
setcookie(session_name(),'',time()-3600,'/');
session_destroy();
header('Location: index.php');
?>
