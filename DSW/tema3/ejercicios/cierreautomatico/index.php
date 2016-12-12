<?php
include('functions.php');
$time = 30; // Segundos tras los cuales se cerrará automáticamente la sesión
$tiempoTranscurrido = 0;
$sessionName = 'autodestruct';

$aux = cookieSetted($sessionName, $time);

setSessionCookie($sessionName,$time);
echo "ID: ".session_id().'<br>';
echo  "Cookie: ";
$cookie = session_get_cookie_params();
print_r($cookie);

if (isset($_SESSION['horaInicio'])) { // Si existe la variable de sesión -> calcular el tiempo de sesión transcurrido
  $horaInicio = $_SESSION['horaInicio'];
  $ahora = date("Y-n-j H:i:s");
  $tiempoTranscurrido = strtotime($ahora) - strtotime($horaInicio);
  $tiempoRestante = ($cookie['lifetime'] - $tiempoTranscurrido) + 2;

  if ($tiempoTranscurrido >= $time) { // HA EXPIRADO EL TIEMPO --> CERRAR LA SESIÓN
    destroy();
  } else {
    $aux['msg'] .= "<p style=\"color:blue;\">
                  Quedan <span id='countdown'></span> seg para que se cierre la sesión.
                </p>
                &nbsp
                <a href=\"index.php\">
                  RECARGAR CONTINUANDO EL VÍDEO
                </a> <br> <br>";
    $self = $_SERVER['PHP_SELF'];
    header("refresh:$tiempoRestante; url=$self"); // recarga la web para comprobar si ha alcanzado el tiempo
  }
} else { // No existe la sesión --> primera vez que se visita --> guardar la hora
  $_SESSION['horaInicio']= date("Y-n-j H:i:s");
}
?>
<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cierre Automático</title>


    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <script src="countDown.js" charset="utf-8"></script>

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
    </div>


    <div id="main">
      <script type="text/javascript">
        updateTime(<?php echo $tiempoRestante; ?>);
        // updateTime(<?php echo ((strtotime('now') - $cookie['lifetime']) * -1); ?>); //versión con now + $time
      </script>
      <?php
      echo $aux['msg'];
      if (!$aux['finSesion']) {
        $paramVideo = "?rel=0&showinfo=0&autoplay=1&start=".$tiempoTranscurrido."\" frameborder=\"0\" allowfullscreen";
        echo "<iframe width=\"580\" height=\"390\" src=\"https://www.youtube.com/embed/JbR999N5MiA".$paramVideo."></iframe>";
      }

      ?>
      </div>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>


</html>
