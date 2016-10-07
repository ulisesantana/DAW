<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ejercicios Básicos de PHP</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
  <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
  <![endif]-->

  <style media="screen">
  body{margin-top:70px}
  </style>
</head>
<body>

  <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"></a>
      </div>

      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="navbar">
        <ul class="nav navbar-nav">
          <li class="active"><a href="fechas.php">Ejercicio Fechas</a></li>
          <li><a href="tabla.php">Ejercicio Tabla</a></li>
          <li><a href="primitiva.php">Ejercicio Primitiva</a></li>
          <li><a href="nota.php">Ejercicio Notas</a></li>
          <li><a href="calculadora.php">Ejercicio Colores</a></li>

        </ul>

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
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

  <div class="container">
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
