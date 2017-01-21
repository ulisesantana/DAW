<?php
$cookie_name = 'contador';
$cookie_expiration_date = time()+(86400 * 365); //En segundos (86400s = 1 día)

if (!isset($_COOKIE[$cookie_name])) {
  $visitsBrowser = 0;
  setcookie($cookie_name, $visitsBrowser, $cookie_expiration_date);
} else {
  $visitsBrowser = $_COOKIE['contador'];
  $visitsBrowser++;
  setcookie($cookie_name, $visitsBrowser, $cookie_expiration_date);
}
 ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Actividad Contador de Visitas con Cookies</title>

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
        <img src="https://avatars3.githubusercontent.com/u/17091490?v=3&s=466" alt="" class="img-responsive img-circle">
        <h3 class="text-center">Ulises Santana Suárez <br><small>2º DAW</small></h3>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav">
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>
        </div>
    </div> <!-- /profile -->

    <div id="main">
      <h3 class="text-center">Actividad Contador de Visitas con Cookies</h3>
      <?php
        //abrimos el archivo en modo lectura
        $file = fopen('contador.txt', 'a+');
        //añadimos la cuenta a un espacio del array y la fecha a otro.
        $visitsServer = [intval(fgets($file)),fgets($file)];
        //cerramos el fichero
        fclose($file);

        //Escribe en el archivo la fecha de la última visita y actualiza el contador
        function setLastVisitServer($visits){
          $counter = $visits[0];
          $file = fopen('contador.txt', 'w+');
          $counter++;
          fputs($file,($counter.PHP_EOL));
          fputs($file,date("d/m/Y H:i:s").PHP_EOL);
        }

        //Array que nos muestra el número de visitas
        function setImageCounter($visits){
          $img=''; //inicializamos la variable que mostrará las visitas en imagen
          $counter = strval($visits); //pillamos las visitas y las pasamos a string
          for ($i=0; $i < strlen($counter); $i++) {
            $img = $img.'<img src="img/'.$counter[$i].'.jpg">';
          }
          return $img;
        }

        setLastVisitServer($visitsServer);
       ?>
       <h4>Visitas desde tu navegador: <?php echo setImageCounter($visitsBrowser); ?></h4>
       <h4>Visitas totales: <?php echo setImageCounter($visitsServer[0]); ?></h4>
    </div> <!-- /main -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
