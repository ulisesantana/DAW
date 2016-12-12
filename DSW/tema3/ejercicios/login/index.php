<?php
  include('functions.php');
  setSessionCookie();
  $color = (isset($_COOKIE['color'])) ? $_COOKIE['color'] : '#BBDDAA';

  if (isset($_SESSION['auth'])) { //existe sesión
    $auth = $_SESSION['auth'];

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
      colorCookie($_POST['color']);
      $color = (isset($_POST['color'])) ? $_POST['color'] : $_COOKIE['color'];
    }
  } else { // no existe la sesión
    header("Location: login.php");
  }

?>
<!DOCTYPE html>
<html lang="es">


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


    <style media="screen">
        @import url('https://fonts.googleapis.com/css?family=Montserrat');
        body {
            background-color: <?php echo $color ?>;
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
        <img src="https://avatars3.githubusercontent.com/u/17091490?v=3&s=466" alt="" class="img-responsive img-circle hidden-sm hidden-xs">
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
      <h2>Estás en el Inicio</h2>

      <h3>
        Has iniciado sesión con el usuario: <strong><?php echo $auth['user']; ?>
        </strong> y la contraseña <strong><?php echo $auth['pass']; ?></strong>
      </h3>

      <p>
        Se ha iniciado sesión a las <?php echo $auth['time']; ?> y te has conectado
        a la IP: <i><?php echo $auth['ip']; ?></i>
      </p>

      <form name="color-form" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
            <input name="color" type="radio"
              value="red" <?php if($color == 'red') echo 'checked'; ?> required> Rojo
            <input name="color" type="radio"
              value="aqua" <?php if($color == 'aqua') echo 'checked'; ?> > Azul
            <input name="color" type="radio"
              value="green" <?php if($color == 'green') echo 'checked'; ?> > Verde
            <input name="enviar" type="submit" value="CAMBIAR">
      </form>

      <hr>

      <a href="logout.php">CERRAR SESIÓN</a>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>


</html>
