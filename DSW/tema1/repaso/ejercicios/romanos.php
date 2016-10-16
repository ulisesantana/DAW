<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Repaso básico de PHP - Números Romanos</title>

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

        .space{padding-top:5%;}
    </style>
</head>

<body>
    <div id="profile">
        <a href="../index.php"><img src="https://avatars3.githubusercontent.com/u/17091490?v=3&s=466" alt="" class="img-responsive img-circle"></a>
        <h3 class="text-center">Ulises Santana Suárez <br><small>2º DAW</small></h3>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav">
              <li><a href="eliminarsubcadena.php">Eliminar Subcadena</a></li>
              <li><a href="ordenar.php">Ordenar Arrays</a></li>
              <li class="active"><a href="romanos.php">Números Romanos</a></li>
            </ul>
        </div>
    </div>

    <div id="main">

      <?php
      function romanNumberHelper($arabicAux,$first,$second,$max){
        $romanNumber='';
        if($arabicAux == 9){
          $romanNumber.=$max;
        }
        elseif($arabicAux < 5) {//Del 1 al 4
          for ($i=0; $i < $arabicAux; $i++) {
            if($arabicAux < 4) {//Si no es 4 entonces...
              $romanNumber.=$first;
            }
            else {//Si no entonces directamente ponle el valor y sale del for
              $romanNumber.=$first.$second;
              break;
            }
          }
        }
        else {//Del 5 al 8
          for ($i=0; $i < ($arabicAux-4); $i++) {
            ($i==0) ? $romanNumber.=$second : $romanNumber.=$first;
          }
        }
        return $romanNumber;
      }

      //$arabicNumber => número que nos pasa el usuario.
      //$arabicString => $arabicNumber pasado a String para trabajar con sus posiciones
      //$arabicAux => int de una posición concreta de $arabicNumber
      //$romanNumber => string que devolverá la función
      function romanNumberConverter($arabicNumber){
        $romanNumber='';
        $arabicString = str_split($arabicNumber);
        $lim = count($arabicString);

        for ($i=0; $i <= $lim; $i++) {
          $length = count($arabicString);
          switch ($length) {
            case 1://Unidades
              $arabicAux = intval($arabicString[0]);
              $romanNumber.=romanNumberHelper($arabicAux,'I','V','IX');
              break;
            case 2://Decenas
              $arabicAux = intval($arabicString[0]);
              $romanNumber.=romanNumberHelper($arabicAux,'X','L','XC');
              break;
            case 3://Centenas
              $arabicAux = intval($arabicString[0]);
              $romanNumber.=romanNumberHelper($arabicAux,'C','D','CM');
              break;
            case 4://Millares
              $arabicAux = intval($arabicString[0]);
              for ($j=0; $j < ($arabicAux); $j++) {
                if($j<3) {
                  $romanNumber.='M';
                }
              }
              break;
          }
          array_shift($arabicString); //Elimina el primer elemento
        }
        return $romanNumber;
      }
      ?>
        <h1 class="text-center">Números romanos</h1>
        <div class="row">
          <div class="col-md-6">
            <div class="space"></div>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <small>Número que quieres pasar a romano:</small>
              <input required type="number" min="1" max="3999" name="arabicNumber" value="<?php echo $arabicNumber;?>">
              <div class="space"></div>
                <input class="btn btn-success center-block" type="submit" value="CONVERTIR">
            </form>

          </div>
          <div class="col-md-6">

            <?php
            //Al pulsar submit se entra en este if
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
              //Sólo muestra el resultado si la variable está seteada
              if (!empty($_POST['arabicNumber'])) {
                $arabicNumber = $_POST['arabicNumber'];
                $output = romanNumberConverter($arabicNumber);
                echo '<br>
                <h4 class="text-center">El número '.$arabicNumber.' en romano</h4>
                <h4 class="text-center lead">'.$output.'</h4>';

              }
            }
            ?>

          </div>

        </div><!-- /row -->
        <div class="row">
          <h3 class="text-center">Números romanos del 1 al 3999 </h3>
          <div class="col-md-3">
            <h4 class="text-center"> Del 1 al 999</h4>
            <?php
            for ($i=1; $i < 1000; $i++) {
              echo '<br><strong>'.$i.'</strong>.- '.romanNumberConverter($i);
            }
            ?>
          </div>
          <div class="col-md-3">
            <h4 class="text-center"> Del 1000 al 1999</h4>
            <?php
            for ($i=1000; $i < 2000; $i++) {
              echo '<br><strong>'.$i.'</strong>.- '.romanNumberConverter($i);
            }
            ?>
          </div>
          <div class="col-md-3">
            <h4 class="text-center"> Del 2000 al 2999</h4>
            <?php
            for ($i=2000; $i < 3000; $i++) {
              echo '<br><strong>'.$i.'</strong>.- '.romanNumberConverter($i);
            }
            ?>
          </div>
          <div class="col-md-3">
            <h4 class="text-center"> Del 3000 al 3999</h4>
            <?php
            for ($i=3000; $i < 4000; $i++) {
              echo '<br><strong>'.$i.'</strong>.- '.romanNumberConverter($i);
            }
            ?>
          </div>

        </div>
    </div> <!-- /main -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
