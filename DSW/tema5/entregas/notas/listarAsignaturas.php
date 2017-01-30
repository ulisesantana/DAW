<?php
session_start();

if (isset($_SESSION['usuario']) && isset($_SESSION['tipo'])) {
  $tipo = $_SESSION['tipo'];
  if ($tipo == "Profesor") {
    $profesor = $_SESSION['usuario'];
  } else {
    header("Location: login.php");
  }
} else {
  header("Location: login.php");
}

$conexion = new mysqli("localhost", "dsw", "dsw", "db_notas_varias_asignaturas");
if ($conexion->connect_error)
die("Conexión fallida: ".$conexion->connect_error);

$consultaSQL = "SELECT `asignatura` FROM `t_asignaturas` WHERE profesor = '".$profesor."' ;";
$resultado = $conexion->query($consultaSQL);
$asignaturas = [];
$options = '';
if ($resultado->num_rows > 0) {
  while ($row = mysqli_fetch_assoc($resultado)) {
    if(!in_array($row, $asignaturas)) $asignaturas[] = $row;
  }
  $resultado->close();
  for($i=0; $i < sizeof($asignaturas); $i++) {
    $options.='<option value="'.$asignaturas[$i]['asignatura'].'">'.$asignaturas[$i]['asignatura'].'</option>';
  }
  echo $options;
} else
return false;

$conexion->close();
?>
