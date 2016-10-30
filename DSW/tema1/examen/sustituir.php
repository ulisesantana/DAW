<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Examen DSW Tema 1</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

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

          #profile li.active{
            background-color: #eee;
          }

          #main {
              width: 73vw;
              padding: 2% 3%;
              margin-left: 24vw;
          }

          .space{padding-top:5%;}
      </style>
</head>

<body>

    <div id="profile">
      <a href="index.php">
        <img src="https://avatars3.githubusercontent.com/u/17091490?v=3&s=466" alt="" class="img-responsive img-circle">
      </a>
        <h3 class="text-center">Ulises Santana Suárez <br><small>2º DAW</small></h3>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav">
                <li><a href="puedeformarse.php"> Ejercicio 1 - puedeformarse.php</a></li>
                <li class="active"><a href="sustituir.php"> Ejercicio 2 - sustituir.php</a></li>
                <li><a href="devolver.php"> Ejercicio 3 - devolver.php</a></li>
            </ul>
        </div>
    </div> <!-- /profile -->

    <div id="main">
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
      $formArray = $oldValue = $newValue = "";

      // Variables para mostrar los posibles errores encontrados al validar:
      $formArrayError = $oldValueError = $newValueError = "";

      // Validación:
      if ($_SERVER['REQUEST_METHOD'] == "POST") {

        (empty($_POST['formArray'])) ? $formArrayError = "Si no me das el array vamos mal." : $formArray = cleanValue($_POST['formArray']);
        (empty($_POST['oldValue'])) ? $oldValueError = "¿No hay algo que querías cambiar?" : $oldValue = cleanValue($_POST['oldValue']);
        (empty($_POST['newValue'])) ? $newValueError = "O me das un número nuevo o te la monto bien berraca." : $newValue = cleanValue($_POST['newValue']);

        if (!is_numeric($oldValue)) {
          $oldValueError = "Necesito que sea un número mayor de 0";
        }
        elseif($oldValue <= 0) {
          $oldValueError = "Necesito que sea un número mayor de 0";
  	    }

        if (!is_numeric($newValue)) {
          $newValueError = "Necesito que sea un número mayor de 0";
        }
        elseif($newValue <= 0) {
          $newValueError = "Necesito que sea un número mayor de 0";
  	    }
    }
      ?>

      <h1 class="text-center">Puede formarse</h1>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="row">
        <div class="col-md-4">
          Array: <input required type="text" name="formArray" value="<?php echo $formArray;?>">
          <br>
          <?php printError($formArrayError); ?>
        </div>
        <div class="col-md-4">
          Valor a sustituir: <input required type="text" name="oldValue" value="<?php echo $oldValue;?>">
          <br>
          <?php printError($oldValueError); ?>
        </div>
        <div class="col-md-4">
          Nuevo Valor: <input required type="text" name="newValue" value="<?php echo $newValue;?>">
          <br>
          <?php printError($newValueError); ?>
        </div>
      </div>
        <input class="btn btn-success center-block" type="submit" value="SUSTITUIR">
      </form>

      <?php
      //Al pulsar submit se entra en este if
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Sólo muestra el resultado si las tres variables está
        if (!empty($_POST['formArray']) && !empty($_POST['oldValue']) && !empty($_POST['newValue'])) {
        $checkArray = explode(',',$formArray);
        $newArray = [];
        $output='';
        for ($i=0; $i < count($checkArray); $i++) {
          if($oldValue == $checkArray[$i]){
            $newArray[$i] = $newValue;
          }
          else {
            $newArray[$i] = $checkArray[$i];
          }
        }

        for ($i=0; $i < count($newArray); $i++) {
          ($i==count($newArray)-1) ? $output.=$newArray[$i].'.' : $output.=$newArray[$i].', ';
        }

         echo '<br><h3 class="text-center">Resultado:</h3><h4 class="text-center">'.$output.'</h4>';
       }
      }
      ?>

      </div> <!-- /main -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
