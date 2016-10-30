<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contador de Visitas</title>

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
    <?php
      //abrimos el archivo en modo lectura
      $file = fopen('contador.txt', 'a+');
      //añadimos la cuenta a un espacio del array y la fecha a otro.
      $visits = [intval(fgets($file)),fgets($file)];
      //cerramos el fichero
      fclose($file);

      //Escribe en el archivo la fecha de la última visita y actualiza el contador
      function setLastVisit($visits){
        $counter = $visits[0];
        $file = fopen('contador.txt', 'w+');
        $counter+=1;
        fputs($file,($counter.PHP_EOL));
        fputs($file,date("d/m/Y H:i:s").PHP_EOL);
      }

      //Array que nos muestra el número de visitas
      function setImageCounter($visits){
        $img=''; //inicializamos la variable que mostrará las visitas en imagen
        $counter = strval($visits[0]); //pillamos las visitas y las pasamos a string
        for ($i=0; $i < strlen($counter); $i++) {
          $img = $img.'<img src="img/'.$counter[$i].'.jpg">';
        }
        return $img;
      }

      setLastVisit($visits);
     ?>

     <h1 class="text-center">Esta página ha sido visitada <?php echo $visits[0] ?> veces</h1>
     <h2 class="text-center">La última vez fue el <?php echo $visits[1] ?></h2>
     <div class="text-center">
      <?php echo setImageCounter($visits); ?>
     </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
