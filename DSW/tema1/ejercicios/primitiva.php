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
          <li class="active"><a href="tabla.php">Ejercicio Tabla</a></li>
          <li><a href="primitiva.php">Ejercicio Primitiva</a></li>
          <li><a href="nota.php">Ejercicio Notas</a></li>
          <li><a href="calculadora.php">Ejercicio Colores</a></li>

        </ul>

      </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
  </nav>

  <div class="container">
      <table class="table">
        <?php
        $numbers=[];
        for ($i=0; $i < 6; $i++) {
          $aux=rand(1,7);
           $numbers[$i] = $aux;
          for ($j=0; $j < $i; $j++) {
            if ($aux == $numbers[$j]) {
              $i--;
            }
          }
        }
        echo '<tr>';
        for ($i=0; $i < count($numbers); $i++) {
          echo '<td>'.$numbers[$i].'</td>';
        }
        echo '</tr>';
        ?>
      </table>
    </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
