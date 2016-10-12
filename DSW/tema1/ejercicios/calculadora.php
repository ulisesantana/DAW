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
          <li><a href="nota.php">Ejercicio Notas</a></li>
          <li class="active"><a href="calculadora.php">Ejercicio Calculadora</a></li>
          <li><a href="colores.php">Ejercicio Colores</a></li>
        </ul>

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>
  <?php
  $num1 = (isset($_POST['num1'])) ? $_POST['num1'] : '' ;
  $mark = (isset($_POST['num2'])) ? $_POST['num2'] : '' ;
  $ope = '';
  $text = '';

  if(isset($_POST['sum'])) $ope = $_POST['sum'];
  if(isset($_POST['res'])) $ope = $_POST['res'];
  if(isset($_POST['mul'])) $ope = $_POST['mul'];
  if(isset($_POST['div'])) $ope = $_POST['div'];

  ?>

  <div class="container">
    <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
      <h1 class="text-center text-info">Introduce dos números y haz operaciones con ellos</h1>
      <div class="row">
        <div class="form-group col-md-6">
          <input type="text" class="form-control" name="num1" placeholder="000000000000000.00" value="<?php echo $num1; ?>">
        </div>
        <div class="form-group col-md-6">
          <input type="text" class="form-control" name="num2" placeholder="000000000000000.00" value="<?php echo $num2; ?>">
        </div>
      </div>
      <div class="row form-group" style="margin-left:20px;">
        <label class="radio-inline col-md-3">
          <input type="radio" name="sum">Sumar
        </label>
        <label class="radio-inline col-md-3">
          <input type="radio" name="res">Restar
        </label>
        <label class="radio-inline col-md-3">
          <input type="radio" name="mul">Multiplicar
        </label>
        <label class="radio-inline col-md-2">
          <input type="radio" name="div">Dividir
        </label>
      </div>
      <input type="submit" class="btn btn-success center-block" value="Comprobar">
    </form>
    <div class="center-block">
      <?php echo $text; ?>
    </div>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
