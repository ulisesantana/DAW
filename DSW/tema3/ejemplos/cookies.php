<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title> ¿Es la misma sesión? </title>
</head>
<body bgcolor="#DDDDFF">
  <?php
    // Si existe la cookie de la sesión -> leer el ID que contiene
    if (isset($_COOKIE['PHPSESSID'])) {
      $IDanterior = $_COOKIE['PHPSESSID'];
      $IDactual = session_id();
    } else{
      $IDanterior = "";
      session_start(); // Inicia la sesión si no existe o prosigue con ella
      $IDactual = session_id();
    }
  if ($IDanterior == $IDactual) {
    // Comprobar si el ID actual es el mismo ID que había en la cookie
    echo "<p style=\"color:rgb(0,0,255); font-family:verdana; font-size:18px;\">
            Misma sesión: existe una sesión previa con el ID: ".$IDanterior."
          </p>";

    echo "<p style=\"color:rgb(0,0,200); font-family:arial; font-size:13px;\">
            Se continúa con ella porque existe una cookie con el mismo nombre y el mismo ID
            que la sesión actual.
          </p>";
  } else {
    // Sesión nueva
    echo "<p style=\"color:rgb(0,200,0); font-family:verdana; font-size:18px;\">
            Nueva sesión: no existe ninguna sesión previa.
          </p>";

    echo "<p style=\"color:rgb(0,200,0); font-family:verdana; font-size:18px;\">
            Se crea una nueva sesión con el ID: ".$IDactual."
          </p>";

    echo "<p style=\"color:rgb(0,150,0); font-family:arial; font-size:13px;\">
            Nueva porque no existe la cookie con el mismo nombre e ID que la actual.
          </p>";
  }
  echo "<hr>";
  echo "<h4> Datos de la sesión actual: </h4>";

  echo "&nbsp; &nbsp; ID: ".session_id();
  echo "<br> &nbsp; &nbsp; Nombre: ".session_name()."<br>";

  $cookie = session_get_cookie_params();
  echo "&nbsp; &nbsp; Caducidad de la cookie de sesión: ";
  echo $cookie['lifetime'];
  echo "<br> <br> Estos datos se perderán al cerrar la página y se creará
  una nueva sesión al abrirla otra vez.";
  ?>
  <hr> <br>
  <a href="<?php echo $_SERVER['PHP_SELF']; ?>"> RECARGAR LA PÁGINA </a>
</body>
</html>
