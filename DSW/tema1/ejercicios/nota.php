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
                <li class="active"><a href="nota.php">Ejercicio Notas</a></li>
                <li><a href="calculadora.php">Ejercicio Calculadora</a></li>
            </ul>
        </div>
    </div>
    <!-- /profile -->

    <div id="main">
        <?php
      $mark = (isset($_POST['nota'])) ? $_POST['nota'] : '' ;
      $text = '';

      function validarNota ($mark) {
        $notaValidada = ($mark>=0 && $mark <= 10) ? true : false;
        return $notaValidada;
      }

      if (isset($_POST['nota'])) {
        if (validarNota($mark)) {
          if ($mark < 5) {
            $text = '<div class="alert alert-danger"><h3 class="text-center text-danger"> SUSPENSO </h3></div>';
          } elseif ($mark >= 5 && $mark < 7) {
            $text = '<div class="alert alert-warning"><h3 class="text-center text-warning"> APROBADO </h3></div>';
          } elseif ($mark >= 7 && $mark < 9) {
            $text = '<div class="alert alert-info"><h3 class="text-center text-info"> NOTABLE </h3></div>';
          } else {
            $text = '<div class="alert alert-success"><h3 class="text-center text-success"> SOBRESALIENTE </h3></div>';
          }
        } else {
          $text = '<div class="alert alert-danger"><h3 class="text-center text-danger"> El formato de nota no es correcto. </h3></div>';
        }
      }
      ?>

                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
                    <div class="form-group">
                        <label for="fecha">Nota</label>
                        <input type="text" class="form-control" name="nota" placeholder="5" value="<?php echo $mark; ?>">
                        <p class="help-block">Introduce tu nota entre 1 y 10</p>
                        <input type="submit" class="btn btn-success" value="Comprobar">
                    </div>
                </form>
                <div class="center-block">
                    <?php echo $text; ?>
                </div>
                <!-- /main -->

                <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
                <!-- Include all compiled plugins (below), or include individual files as needed -->
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
