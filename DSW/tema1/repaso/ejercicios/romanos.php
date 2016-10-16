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
      //$arabicNumber => número que nos pasa el usuario.
      //$arabicString => $arabicNumber pasado a String para trabajar con sus posiciones
      //$arabicAux => int de una posición concreta de $arabicNumber
      //$romanNumber => string que devolverá la función
      function romanNumberConverter($arabicNumber, $romanNumber=''){
        $arabicString = str_split($arabicNumber);

        for ($i=0; $i <= count($arabicString); $i++) {
          if(count($arabicString) > 1){
            if($arabicNumber >= 90){//Decenas del 90
              $romanNumber.='XC';
            } elseif($arabicNumber >= 50) { //Decenas del 50 al 80
              //Pasamos el número del índice 0 a una variable
              $arabicAux = intval($arabicString[0]);
              for ($j=0; $j < $arabicAux-4; $j++)  {
                ($j==0) ? $romanNumber.='L' : $romanNumber.='X';
              }
            } else {//Decenas hasta el 40
              for ($j=0; $j < $arabicAux; $j++)  {
                if($arabicAux < 4) {//Si la decena no empieza por 4 entonces...
                  $romanNumber.='X';
                } else {//Si no entonces directamente ponle el valor y sal del for
                  $romanNumber.='XL';
                  break;
                }
              }
            }
          } else { //Números menores a 10
            $arabicAux = intval($arabicString[0]);
            if($arabicAux == 9){
              $romanNumber.='IX';
            } elseif($arabicAux < 5) {//Del 1 al 5
              for ($j=0; $j < $arabicAux; $j++) {
                ($j!=3) ? $romanNumber.='I' : $romanNumber.='V';
              }
            } else {//Del 5 al 8
              for ($j=0; $j < ($arabicAux-4); $j++) {
                ($j==0) ? $romanNumber.='V' : $romanNumber.='I';
              }
            }
          }
          $arabicString=implode($arabicString); //Pasa el array a un único valor
          $arabicString=substr($arabicString,1);//Le quitamos el valor de la posición 0
          //Volvemos a pasar a array para actualizar los valores que quedan
          $arabicString = str_split($arabicString);
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
              <input required type="number" min="1" max="99" name="arabicNumber" value="<?php echo $arabicNumber;?>">
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
                <h3 class="text-center">El número '.$arabicNumber.' en romano</h3>
                <h4 class="text-center lead">'.$output.'</h4>';
              }
            }
            ?>

          </div>

        </div><!-- /row -->
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
