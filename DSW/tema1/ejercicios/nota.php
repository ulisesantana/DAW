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
          <li><a href="fechas.php">Ejercicio Fechas</a></li>
          <li><a href="tabla.php">Ejercicio Tabla</a></li>
          <li><a href="primitiva.php">Ejercicio Primitiva</a></li>
          <li class="active"><a href="nota.php">Ejercicio Notas</a></li>
          <li><a href="calculadora.php">Ejercicio Calculadora</a></li>
          <li><a href="colores.php">Ejercicio Colores</a></li>


        </ul>

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
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

  <div class="container">
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
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
