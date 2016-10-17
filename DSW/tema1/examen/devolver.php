<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Examen DSW Tema 1</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

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
      <a href="index.php">
        <img src="https://avatars3.githubusercontent.com/u/17091490?v=3&s=466" alt="" class="img-responsive img-circle">
      </a>
        <h3 class="text-center">Ulises Santana Suárez <br><small>2º DAW</small></h3>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav">
                <li><a href="puedeformarse.php"> Ejercicio 1 - puedeformarse.php</a></li>
                <li><a href="sustituir.php"> Ejercicio 2 - sustituir.php</a></li>
                <li class="active"><a href="devolver.php"> Ejercicio 3 - devolver.php</a></li>
            </ul>
        </div>
    </div> <!-- /profile -->

    <div id="main">
      <?php
      function cleanValue (&$data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      }

      function printError ($error) {
        echo '<span class="alert text-danger">'.$error.'</span>';
      }

      // Variables para almacenar los valores leidos del formulario:
      $amount = "";

      // Variables para mostrar los posibles errores encontrados al validar:
      $amountError = "";

      // Validación:
      if ($_SERVER['REQUEST_METHOD'] == "POST") {

        (empty($_POST['amount'])) ? $amountError = "¿No querías saber el cambio de algo?" : $amount = cleanValue($_POST['amount']);

        if (!is_numeric($amount)) {
          $amountError = "Necesito que introduzcas un importe";
        }
        elseif($amount <= 0) {
          $amountError = "Necesito que sea un número mayor de 0";
  	    }
        elseif($amount > 30) {
          $amountError = "Necesito que sea un número menor de 30";
  	    }
      }


      //Calculador de cambio
      function giveMeChange($amount){
          $change = '';
          $amount=intval($amount);

          while ($amount > 0) {
            if($amount >= 20){
              $change.='1 billete de 20€<br>';
              $amount=$amount-20;
            }
            elseif($amount >= 10){
              $change.='1 billete de 10€<br>';
              $amount=$amount-10;
            }
            elseif($amount >= 5){
              $change.='1 billete de 5€<br>';
              $amount=$amount-5;
            }
            elseif($amount >= 2){
              $change.='1 moneda de 2€<br>';
              $amount=$amount-2;
            }
            elseif($amount >= 1){
              $change.='1 moneda de 1€<br>';
              $amount=$amount-1;
            }
        }
        return $change;
      }

    ?>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="row">
        <div class="col-md-6">
          Importe: <input required type="number" name="amount" value="<?php echo $amount;?>">
          <br>
          <?php printError($amountError); ?>
          <div class="space"></div>
          <input class="btn btn-success center-block" type="submit" value="DAR CAMBIO">
        </form>
        </div>
        <div class="col-md-6">
          <h2 class="text-center">Cambio</h2>
          <p class="text-center">
            <?php echo giveMeChange($amount) ?>
          </p>
        </div>
      </div>

    </div> <!-- /main -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
