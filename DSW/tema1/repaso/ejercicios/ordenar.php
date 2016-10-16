<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Repaso básico de PHP - Ordenar Arrays</title>

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
      // Existe otra función para números aleatorios que se recomienda para
      // uso criptográfico que es random_int ( int $min , int $max ). La función
      // rand() nos sirve para cualquier número que no sea crítico.
      for ($i=0; $i < 10; $i++) $list[$i] = rand();
      $sortedList = $list;
      sort($sortedList);
      // La función sort ordena un array. Los elementos estarán ordenados
      // de menor a mayor cuando la función haya terminado.


      //Solución de Juan Espino
      // for ($i = 0; $i < count($vector)-1; $i++) {
      //   $minimo = $vector[$i];
      //   $posicionMinimo = $i;
      //   for ($j = $i+1; $j < count($vector); $j++) {
      //     if ($vector[$j] < $minimo) {
      //       $minimo = $vector[$j];
      //       $posicionMinimo = $j;
      //     }
      //   }
      //
      //   $aux = $vector[$i];
      //   $vector[$i] = $minimo;
      //   $vector[$posicionMinimo] = $aux;
      // }

    ?>
</head>

<body>
    <div id="profile">
        <a href="../index.php"><img src="https://avatars3.githubusercontent.com/u/17091490?v=3&s=466" alt="" class="img-responsive img-circle"></a>
        <h3 class="text-center">Ulises Santana Suárez <br><small>2º DAW</small></h3>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav">
              <li><a href="eliminarsubcadena.php">Eliminar Subcadena</a></li>
              <li class="active"><a href="ordenar.php">Ordenar Arrays</a></li>
              <li><a href="romanos.php">Números Romanos</a></li>
            </ul>
        </div>
    </div>

    <div id="main">
        <h1 class="text-center">Ordenar Arrays</h1>
        <div class="row">
          <div class="col-md-6">
            <h3>Array desordenado</h3>
            <h4>
              <?php
                foreach ($list as $number) {
                  //number_format($número,número_de_decimales,separador_de_decimales,separador_de_miles)
                  echo number_format($number,0,',','.').'<br>';
                }
              ?>
            </h4>
          </div>
          <div class="col-md-6">
            <h3>Array ordenado</h3>
            <h4>
              <?php
                foreach ($sortedList as $number) {
                  echo number_format($number,0,',','.').'<br>';
                }
              ?>
            </h4>
          </div>
        </div>


    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
