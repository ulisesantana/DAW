<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ejercicios PHP - Tema 2</title>

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
                <li>
                  <a href="xml.php">0. Testeando XML</a>
                </li>
                <li>
                    <a href="recuento.php">1. Recuento PHP</a>
                </li>
                <li>
                    <a href="justifica.php">2. Justifica PHP</a>
                </li>
                <li>
                    <a href="coches/index.html">3. Web de Coches</a>
                </li>
            </ul>
        </div>
    </div>
    <!-- /profile -->

    <div id="main">
      <p>
        <?php
        $text = [];
        $lines = -1;//Aunque no haya texto en el archivo contará como una línea
        $chars = 0;
        $words = -1;//Cuenta el final como una palabra más
        $a = 0;
        //abrimos el archivo en modo lectura
        $file = fopen('texto_prueba.txt', 'r');
        //añadimos la cuenta a un espacio del array y la fecha a otro.
        for ($i=0; !feof($file); $i++) {
          $text[$i]=fgets($file);
          $words += count(explode(' ', $text[$i]));
          $lines++;
          $a+=substr_count($text[$i],'a')+substr_count($text[$i],'A')+
            substr_count($text[$i],'á')+substr_count($text[$i],'Á');
          $chars += strlen($text[$i]);
        }

        //cerramos el fichero
        fclose($file);

        for ($i=0; $i < count($text); $i++) {
          echo $text[$i].'</br>';
        }

        echo '</br>'.'</br>';
        echo '<strong>Palabras:</strong> '.$words.'</br>';
        echo '<strong>Caracteres: </strong>'.$chars.'</br>';
        echo '<strong>Líneas: </strong>'.$lines.'</br>';
        echo '<strong>A/a: </strong>'.$a.'</br>';

        ?>

      </p>
    <!-- /main -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
