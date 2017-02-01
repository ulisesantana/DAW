<?php
// Datos para la conexión con la base de datos
$user = 'root';
$pass = 'vamosapetarla';
$db = 'db_agenda';

// Método por el que viene la petición http
$method = $_SERVER['REQUEST_METHOD'];

$conexion = new mysqli("localhost", $user, $pass, $db);
if ($conexion->connect_error)
  die("Conexión fallnombrea: ".$conexion->connect_error);


if ($method == 'GET') {
  if (!isset($_GET['id'])) {
    $contactos = todosLosContactos();
    echo json_encode($contactos);
  } else{
    $contacto = getUnContacto($_GET['id']);
    echo json_encode($contacto);
  }
}

if ($method == 'POST') {
  if (isset($_REQUEST['nombre']) && isset($_REQUEST['telefono'])) {
    $nombre = $_REQUEST['nombre'];
    $telefono = $_REQUEST['telefono'];
		$consultaSQL = 'INSERT INTO `t_contactos` (`nombre`, `telefono`)
											VALUES ("'.$nombre.'", "'.$telefono.'");';

		if ($conexion->query($consultaSQL) === FALSE) {
			echo "Error: ".$conexion->error;
		} else{
      $contactos = todosLosContactos();
      echo json_encode($contactos);
		}
  }
}

if ($method == 'PUT') {
  // if (isset($_GET['id'])) {
    $id = $_GET['id'];

    if(isset($_GET['nombre']) && isset($_GET['telefono'])){
      $nombre = $_GET['nombre'];
      $telefono = $_GET['telefono'];
      $consultaSQL = 'UPDATE `t_contactos`
                        SET telefono = "'.$telefono.'", nombre = "'.$nombre.'"
                        WHERE id = '.$id.';';

    } elseif (isset($_GET['nombre'])) {
      $nombre = $_GET['nombre'];
      $consultaSQL = 'UPDATE `t_contactos`
                        SET nombre = "'.$nombre.'" WHERE id = '.$id.';';

    } else {
      $telefono = $_GET['telefono'];
      $consultaSQL = 'UPDATE `t_contactos`
                        SET telefono = "'.$telefono.'" WHERE id = '.$id.';';
    }

		if ($conexion->query($consultaSQL) === FALSE) {
			echo "Error: ".$conexion->error;
		} else {
      $contactos = todosLosContactos();
      echo json_encode($contactos);
		}
  // }
}

if ($method == 'DELETE') {
  // if (isset($_GET['id'])) {
    $consultaSQL = 'DELETE FROM `t_contactos` WHERE id = '.$_GET['id'].';';
			if ($conexion->query($consultaSQL) === FALSE) {
				echo "Error: ".$conexion->error;
			} else {
        $contactos = todosLosContactos();
        echo json_encode($contactos);
      }
  // }
}

$conexion->close();

function todosLosContactos(){
  global $conexion;
  $sql = 'SELECT * FROM `t_contactos` ORDER BY id;';

  if(!$result = mysqli_query($conexion, $sql))
    die();

  $contactos = [];

  while($row = mysqli_fetch_array($result)){
    for ($i=0; $i <= count($row)/2; $i++) {
      unset($row[$i]);
    }
    $contactos[] = $row;
  }

  return $contactos;
}

function getUnContacto($id){
  global $conexion;
  $sql = 'SELECT * FROM `t_contactos` WHERE id = '.$id.';';

  if(!$result = mysqli_query($conexion, $sql))
    die();

  $contacto = [];

  while($row = mysqli_fetch_array($result)){
    for ($i=0; $i <= count($row)/2; $i++) {
      unset($row[$i]);
    }
    $contacto[] = $row;
  }

  return $contacto;
}
?>
