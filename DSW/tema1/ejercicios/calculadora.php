<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ejercicios Básicos de PHP</title>

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
                <li><a href="test.php">Ejercicio de testeo</a></li>
                <li><a href="fechas.php">Ejercicio Fechas</a></li>
                <li><a href="tabla.php">Ejercicio Tabla</a></li>
                <li><a href="primitiva.php">Ejercicio Primitiva</a></li>
                <li><a href="nota.php">Ejercicio Notas</a></li>
                <li class="active"><a href="calculadora.php">Ejercicio Calculadora</a></li>
            </ul>
        </div>
    </div>
    <!-- /profile -->

    <div id="main">
        <?php

        function procesarValor (&$dato) {
          $dato = trim($dato);
          $dato = stripslashes($dato);
          $dato = htmlspecialchars($dato);
          return $dato;
        }

        function imprimeError ($error) {
        echo '<span class="text-danger">'.$error.'</span>';
        }

        // Variables para almacenar los valores leidos del formulario:
        $num1 = $num2 = $op = "";
        $error = "";

        // Validación:
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
          (empty($_POST['numero1'])) ? $error .= "<br>Se requiere el numero 1" : $num1 = procesarValor($_POST['numero1']);
          (empty($_POST['numero2'])) ? $error .= "<br>Se requiere el numero 2" : $num2 = procesarValor($_POST['numero2']);
          (empty($_POST['operacion'])) ? $error = "<br>Se requiere una operación a realizar" : $op = procesarValor($_POST["operacion"]);
        }
      ?>


            <!-- FORMULARIO -->
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
                <div class="row">
                    <div class="col-md-6">
                        Número 1: <input type="text" name="numero1" value="<?php echo $num1;?>">
                    </div>
                    <div class="col-md-6">
                        Número 2: <input type="text" name="numero2" value="<?php echo $num2;?>">
                    </div>
                </div>
                <h3 class="text-center">Operación:</h3>
                <div class="row">
                    <div class="col-md-3">
                        <input type="radio" name="operacion" <?php if (isset($op) && $op=='suma' ) echo 'checked';?> value="suma">Suma<br>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="operacion" <?php if (isset($op) && $op=='resta' ) echo 'checked';?> value="resta">Resta<br>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="operacion" <?php if (isset($op) && $op=='multiplicacion' ) echo 'checked';?> value="multiplicacion">Multiplicación<br>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" name="operacion" <?php if (isset($op) && $op=='division' ) echo 'checked';?> value="division">División
                    </div>
                </div>
                <div class="space"></div>
                <input class="btn btn-success center-block" type="submit" name="submit" value="CALCULAR">
            </form>

            <!-- VALORES LEIDOS DEL FORMULARIO: -->
            <?php
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
           echo '<span class="text-info">';
           echo '<br><br><h2>Resultado:</h2>';

         switch ($op) {
          case 'suma':
            $result = $num1 + $num2;
            $op = '+';
            break;
          case 'resta':
            $result = $num1 - $num2;
            $op = '-';
            break;
          case 'multiplicacion':
            $result = $num1 * $num2;
            $op = '*';
            break;
          case 'division':
            $result = $num1 / $num2;
            $op = '/';
            break;
         }

           echo $num1 . ' ' . $op . ' ' . $num2 . ' = ' . $result;

           echo '</span>';
         imprimeError($error);
        }
      ?>
    </div>
    <!-- /main -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
