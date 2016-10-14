<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <div class="jumbotron">
    <div class="container">
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

      </ul>

      </p>
    </div>
  </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
