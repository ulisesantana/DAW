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
                <li class="active"><a href="fechas.php">Ejercicio Fechas</a></li>
                <li><a href="tabla.php">Ejercicio Tabla</a></li>
                <li><a href="primitiva.php">Ejercicio Primitiva</a></li>
                <li><a href="nota.php">Ejercicio Notas</a></li>
                <li><a href="calculadora.php">Ejercicio Calculadora</a></li>
            </ul>
        </div>
    </div>
    <!-- /profile -->

    <div id="main">
      <?php
      $date = (isset($_POST['fecha'])) ? $_POST['fecha'] : '' ;
      $today = '';
      $errors = ' ';

      function validarFecha ($date) {
        //Declaramos que $errors apunte a la variable global $errors
        global $errors;

        // Comprueba si $date tiene el formato requerido:  dd/mm/aaaa
        $arrayOfDate = explode("/", $date);
        $day = $arrayOfDate[0];
        $errors = ($day>31) ? $errors.'No hay más de 31 días en un mes.</br>' : '';
        $month = $arrayOfDate[1];
        $errors = ($month>12) ? $errors.'No hay más de 12 meses en un año.</br>' : '';
        $year = $arrayOfDate[2];
        $errors = ($year>2016) ? $errors.'No te flipes que esto no regreso al futuro ni tú eres Marty Mcfly.</br>' : '';
        return checkDate($month, $day, $year);
      }

      if (isset($_POST['fecha'])) {
        if (validarFecha($date)) {
          if ($date == date('d/m/Y')) {
            $today='La fecha que has introducido es correcta y coincide con el día de hoy.';
          } else {
            $today='La fecha que has introducido es correcta,pero no coincide con el día de hoy.';
          }
        } else {
          $today = 'La fecha no la has introducido de manera correcta.';
        }
      }
      ?>

        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
          <div class="form-group">
            <label for="fecha">Fecha</label>
            <input type="text" class="form-control" name="fecha" placeholder="18/03/1989" value="<?php echo $date; ?>">
            <p class="help-block">Introduce la fecha que quieras validar en formato dd/mm/aaaa</p>
            <input type="submit" value="Validar">
          </div>
        </form>
        <div class="center-block">
          <h3 class="text-center text-danger"> <?php echo $errors; ?> </h3>
          <h3 class="text-center text-danger"> <?php echo $today; ?> </h3>
        </div>
      </div>
    <!-- /main -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
