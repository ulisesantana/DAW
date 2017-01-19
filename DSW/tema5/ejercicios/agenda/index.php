<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agenda tóa loca</title>


    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <style media="screen">
        @import url('https://fonts.googleapis.com/css?family=Montserrat');
        body {
            background-color: #eee;
            font-family: "Montserrat", sans-serif;
        }

        #profile {
            background-color: #333;
            color: #fff;
            height: 100vh;
            width: 25vw;
            position: fixed;
        }

        #profile img {
            max-width: 150px;
            margin: 20px auto;
        }

        #profile h3 {
            text-align: center;
            padding: 15px;
        }

        #profile li.active {
            background-color: #eee;
        }

        #main {
            width: 73vw;
            padding: 2% 3%;
            margin-left: 24vw;
        }

        .space {
            padding-top: 5%;
        }
    </style>
</head>


<body>


    <div id="profile">
        <img src="https://avatars3.githubusercontent.com/u/17091490?v=3&s=466" alt="" class="img-responsive img-circle">
        <h3 class="text-center">Ulises Santana Suárez <br><small>2º DAW</small></h3>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav">
                <li>
                    <a href="#"></a>
                </li>
                <li>
                    <a href="#"></a>
                </li>
                <li>
                    <a href="#"></a>
                </li>
                <li>
                    <a href="#"></a>
                </li>
            </ul>
        </div>
    </div>

        <div id="main">
            <p class="titulo">Base de Datos de contactos:</p>

            <form method="post" action="" class="texto">

                <table>

                    <tr>
                        <td>Nombre:</td>

                        <td colspan="2"><input type="text" name="nombre" size="20" maxlength="20"></td>

                    </tr>

                    <tr>
                        <td>Teléfono:</td>

                        <td colspan="2"><input type="number" name="telefono" size="20"></td>

                    </tr>

                    <tr height="10"></tr>

                    <tr>
                        <td><input type="submit" name="buscar" value="BUSCAR"></td>

                        <td><input type="submit" name="anadir" value="AÑADIR"></td>

                        <td><input type="submit" name="eliminar" value="ELIMINAR"></td>

                    </tr>

                </table>

            </form>

            <br>
            <hr align="left" width="270">

            <?php

              function existeContacto ($nombre) {
                global $conexion;

                $consultaSQL = "SELECT * FROM t_contactos WHERE nombre = '".$nombre."';";
                $resultado = $conexion->query($consultaSQL);

                if ($resultado->num_rows > 0) return true;
                else return false;
              }

              function buscarContacto ($nombre) { // muestra una tabla con los contactos encontrados

                global $conexion;

                if ($nombre == "") $consultaSQL = "SELECT * FROM t_contactos;";
                else $consultaSQL = "SELECT * FROM t_contactos WHERE nombre LIKE '".$nombre."%';";

                $encontrados = 0;

                if ($resultado = $conexion->query($consultaSQL)) {

                  if ($resultado->num_rows > 0) {
                    echo "<table class=\"texto\" cellpadding=\"10\" border=\"1\"
                      style=\"border-collapse:collapse;\">
                        <tr>
                          <th>Nombre</th>
                          <th>Teléfono</th>
                        </tr>";

                    while ($registro = $resultado->fetch_assoc()) {
                      echo "<tr>
                              <td width=\"100\">".$registro["nombre"]."</td>
                              <td width=\"100\">".$registro["telefono"]."</td>
                            </tr>";
                    }

                    echo "</table>";
                    echo "<p class=\"texto\">
                            ".$resultado->num_rows." contactos encontrados en la agenda
                          </p>";

                    $encontrados = $resultado->num_rows;
                  }
                  $resultado->close();
                }

                return $encontrados;

              }

              if ($_SERVER['REQUEST_METHOD'] == "POST") {
                $servidor = "localhost"; $usuario = "root"; $clave = ""; $baseDatos = "db_agenda";
                $conexion = new mysqli($servidor, $usuario, $clave, $baseDatos);

                if ($conexion->connect_error) die("Conexión fallida: ".$conexion->connect_error);

                if (isset($_POST['buscar'])) {

                  $nombre = $_POST['nombre'];

                  if (buscarContacto($nombre) == 0) echo "<p style=\"color:red;\">
                                                            No se encuentra en la agenda
                                                            el nombre indicado
                                                          </p>";
                }

                if (isset($_POST['anadir'])) {

                  $nombre = $_POST['nombre']; $telefono = $_POST['telefono'];

                  if ($nombre == "" || $telefono == "") {

                    echo "<p style=\"color:red;\">Indique el nombre y el teléfono del contacto a añadir</p>";

                    buscarContacto("");

                  } else {
                    if (existeContacto($nombre)) {
                      echo "<p style=\"color:red;\">Ya existe en la agenda el nombre indicado</p>";
                    } else {
                      $consultaSQL = "INSERT INTO t_contactos (nombre, telefono) VALUES
                        ('".$nombre."',".$telefono.");";

                      if ($conexion->query($consultaSQL) === TRUE)
                        echo "<p style=\"color:green;\">
                                Contacto añadido correctamente a la agenda
                              </p>";
                      else
                        echo "<p style=\"color:red;\">
                                ".$conexion->error."
                              </p>";

                      }

                      buscarContacto("");
                  }

                }
                //SEGUIR ORDENANDO EL CÓDIGO POR AQUÍ
                if (isset($_POST['eliminar'])) {

                  $nombre = $_POST['nombre'];

                  if ($nombre == "") {
                    echo "<p style=\"color:red;\">Debe indicar el nombre del contacto a eliminar</p>";
                    buscarContacto("");
                  }
                  else {
                    $consultaSQL = "DELETE FROM t_contactos WHERE nombre='".$nombre."';";

                    if (existeContacto($nombre)) {
                      if ($conexion->query($consultaSQL) === TRUE) {
                        echo "<p style=\"color:green;\">Contacto eliminado de la agenda</p>";
                      }
                      else {
                        echo "<p style=\"color:red;\">".$conexion->error."</p>";
                      }

                    } else {
                      echo "<p style=\"color:red;\">No existe en la agenda el nombre indicado</p>";
                    }

                    buscarContacto("");

                  }

                }

                $conexion->close();

              }

            ?>
        </div>


        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
