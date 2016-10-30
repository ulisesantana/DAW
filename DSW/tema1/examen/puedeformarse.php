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
                <li class="active"><a href="puedeformarse.php"> Ejercicio 1 - puedeformarse.php</a></li>
                <li><a href="sustituir.php"> Ejercicio 2 - sustituir.php</a></li>
                <li><a href="devolver.php"> Ejercicio 3 - devolver.php</a></li>
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
      $letters = $word = "";

      // Variables para mostrar los posibles errores encontrados al validar:
      $lettersError = $wordError = "";

      // Validación:
      if ($_SERVER['REQUEST_METHOD'] == "POST") {
        (empty($_POST['letters'])) ? $lettersError = "Necesito que me pases las letras." : $letters = cleanValue($_POST['letters']);
        (empty($_POST['word'])) ? $wordError = "Sin palabra no hacemos nada campeón." : $word = cleanValue($_POST['word']) ;
      }
      ?>

      <h1 class="text-center">Puede formarse</h1>
      <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="row">
        <div class="col-md-6">
          Letras: <input required type="text" name="letters" value="<?php echo $letters;?>">
          <br>
          <?php printError($lettersError); ?>
        </div>
        <div class="col-md-6">
          Palabra: <input required type="text" name="word" value="<?php echo $word;?>">
          <br>
          <?php printError($wordError); ?>
        </div>
      </div>
        <input class="btn btn-success center-block" type="submit" value="COMPROBAR">
      </form>

      <?php
      //Al pulsar submit se entra en este if
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //Sólo muestra el resultado si las dos variables está seteado
        if (!empty($_POST['letters']) && !empty($_POST['word'])) {
          $success = false;
          for ($i=0; $i < strlen($word); $i++) {
            for ($j=0; $j < strlen($letters); $j++) {
              if($word[$i] == $letters[$j])  {
                $success = true;
                break;
              } else{
                $success = false;
              }
            }
          }

          if ($success) {
            $output = '<span class="text-success">La palabra '.$word.' puede formarse con '.$letters.'</span>';
          } else {
            $output = '<span class="text-danger">La palabra '.$word.' no puede formarse con '.$letters.'</span>';
          }
         echo '<br><h4 class="text-center">'.$output.'</h4>';
       }
      }
      ?>



    </div> <!-- /main -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
