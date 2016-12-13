<?php
session_name('mi_contador'); // Nombre de la sesión a crear/continuar.Mismo nombre que la cookie a crear
// Crea la sesión con el nombre especificado o se continua si ya existe la sesión
session_start();
// No existe la variable->primera vez que se visita->contador a 1
if (!isset($_SESSION['contador'])) {
  $contador = 1;
  $mensaje = "Es la primera vez que me visitas en esta sesión.";
  $color = "#7799FF";

} else { // Ya existe la variable-> ya ha visitado-> incrementar contador
  $contador = $_SESSION['contador']; // Lee el valor de la variable de sesión
  $contador++;
  $mensaje = "Me has visitado en esta sesión con este navegador " . $contador . " veces.";
  $color = "#FFFF00";
}

$_SESSION['contador'] = $contador; // Guarda en la variable de sesión
?>
<html>
  <head>
    <title>Contador durante la sesión</title>
  </head>

<body bgcolor="<?php echo $color; ?>">
  <h3> <?php echo $mensaje; ?> </h3>
  <br> Al cerrar el navegador me olvidaré del número de visitas.
  <br> Lo siento, soy una sesión, no una cookie. <br> <br>
  <a href="<?php echo $_SERVER['PHP_SELF']; ?>">RECARGAR LA PÁGINA</a>
</body>

</html>
