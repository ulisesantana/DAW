<?php
session_name('session'); // Nombre de la sesión a crear/continuar.Mismo nombre que la cookie a crear
session_start();

$_SESSION = array();
setcookie(session_name('session'),'',time()-3600,'/');
session_destroy();
header('Location: index.php');
?>
