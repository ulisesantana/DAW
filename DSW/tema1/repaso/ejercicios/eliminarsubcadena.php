<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Repaso básico de PHP - Recortar Subcadena</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

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

        #profile li.active{
          background-color: #eee;
        }

        #main {
            width: 73vw;
            padding: 2% 3%;
            margin-left: 24vw;
        }
    </style>
    <?php
    function cleanValue (&$data) {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    function printError ($error) {
      echo '<span class="alert text-danger">'.$error.'</span>';
    }

    // Variables para almacenar los valores leidos del formulario:
    $string = $start = $end = "";

    // Variables para mostrar los posibles errores encontrados al validar:
    $stringError = $startError = $endError = "";

    // Validación:
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
      (empty($_POST['string'])) ? $stringError = "Se requiere la cadena" : $string = cleanValue($_POST['string']);
      (empty($_POST['start'])) ? $startError = "Se requiere la posición inicial" : $start = cleanValue($_POST['start']) ;
      (empty($_POST['end'])) ? $endError = "Se requiere la posición final" : $end = cleanValue($_POST['end']) ;

      if (!is_numeric($start)) {
        $startError = "La posición inicial debe ser un número";
      } elseif ($start<0){
        $startError = "La posición inicial no puede ser menor que 0";
      }

      if (!is_numeric($end)) {
        $endError = "La posición final debe ser un número";
      } elseif ($end < $start || $end >= strlen($string)) {
        $endError = "La posición final es incorrecta";
      }
    }
    ?>
</head>

<body>
    <div id="profile">
        <a href="../index.php"><img src="https://avatars3.githubusercontent.com/u/17091490?v=3&s=466" alt="" class="img-responsive img-circle"></a>
        <h3 class="text-center">Ulises Santana Suárez <br><small>2º DAW</small></h3>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav">
              <li class="active"><a href="eliminarsubcadena.php">Eliminar Subcadena</a></li>
              <li><a href="ordenar.php">Ordenar Arrays</a></li>
              <li><a href="romanos.php">Números Romanos</a></li>
            </ul>
        </div>
    </div>

    <div id="main">
        <h1 class="text-center">Recortar subcadena</h1>


        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <div class="row">
          <div class="col-md-4">
            Cadena: <input required type="text" name="string" value="<?php echo $string;?>">
            <br>
            <?php printError($stringError); ?>
          </div>
          <div class="col-md-4">
            Inicio: <input required type="number" name="start" value="<?php echo $start;?>">
            <br>
            <?php printError($startError); ?>
          </div>
          <div class="col-md-4">
            Fin: <input required type="number" name="end" value="<?php echo $end;?>">
            <br>
            <?php printError($endError); ?>
          </div>
        </div>
          <input class="btn btn-success center-block" type="submit" value="RECORTAR">
        </form>


        <?php
        //Al pulsar submit se entra en este if
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          //Sólo muestra el resultado si las tres variables está
          if (!empty($_POST['string']) && !empty($_POST['start'])
            && !empty($_POST['end'])) {
           $stringBeginning = substr($string, 0, $start);
           $stringEnding = substr($string, $end+1);
           $output = $stringBeginning.$stringEnding;
           echo '<br><h2 class="text-center">Resultado:</h2>
            <h4 class="text-center">'.$output.'</h4>';
         }
        }
        ?>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
