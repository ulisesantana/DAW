<?php
include('functions.php');
session_start();

post($_SERVER['REQUEST_METHOD'],2);
$data = $_SESSION['data'];

if(!isset($_COOKIE['PHPSESSID'])) header('Location: login.php');

if($data['sesion']!='abierto') header("refresh:31");

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
      .principal {
        font-family: arial;
        font-size: 20px;
        color: #0022DD;
        font-weight: bold;
      }

      .titulo {
        font-family: verdana;
        font-size: 15px;
        color: #0000DD;
      }

      .boton {
        height: 30px;
        width: 140px;
        border-radius: 2px 2px 2px 2px;
        border: 1px solid #00DDEE;
        background: #7777FF;
        font-family: Arial;
        font-size: 12px;
        color: #FFF;
      }

      body {
        background-color: #eee;
        font-family: "Montserrat", sans-serif;
        font-size: <?php echo $data['tamano']; ?>px;
      }

      table{
        font-size: <?php echo $data['tamano']; ?>px !important;
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
    </div>
    <!-- /profile -->

    <div id="main">
      <table style="width:80%;" class="table table-striped">
        <tr>
          <td><?php echo ($data['idioma'] == 'ingles') ? "Name" : 'Nombre';?></td>
          <td>
            <?php echo $data['nombre']; ?>
          </td>
        </tr>
        <tr>
          <td><?php echo ($data['idioma'] == 'ingles') ? "Language" : 'Idioma';?></td>
          <td>
            <?php echo $data['idioma']; ?>
            <form class="pull-right" method="post" name="cambiar-idioma" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <select name="idioma" class="boton">
                <option <?php if(isset($data['idioma']) && $data['idioma'] == 'espanol') echo 'selected' ?> value="espanol">
                  <?php echo ($data['idioma'] == 'ingles') ? "Spanish" : 'Español'; ?>
                </option>
                <option <?php if(isset($data['idioma']) && $data['idioma'] == 'ingles') echo 'selected' ?> value="ingles">
                  <?php echo ($data['idioma'] == 'ingles') ? "English" : 'Inglés'; ?>
                </option>
              </select>
              <input type="submit" value="CAMBIAR">
            </form>
          </td>
        </tr>
        <tr>
          <td><?php echo ($data['idioma'] == 'ingles') ? "Size" : 'Tamaño';?></td>
          <td>
            <?php echo $data['tamano']; ?>
            <form class="pull-right" method="post" name="cambiar-tamano" action="<?php echo $_SERVER['PHP_SELF']; ?>">
              <select name="tamano" class="boton">
								<option <?php if(isset($data['tamano']) && $data['tamano'] == '12') echo 'selected' ?> value="12"> 12 px </option>
								<option <?php if(isset($data['tamano']) && $data['tamano'] == '16') echo 'selected' ?> value="16"> 16 px </option>
								<option <?php if(isset($data['tamano']) && $data['tamano'] == '20') echo 'selected' ?> value="20"> 20 px </option>
							</select>
              <input type="submit" value="CAMBIAR">
            </form>
          </td>
        </tr>
        <tr>
          <td><?php echo ($data['idioma'] == 'ingles') ? "Keep session alive" : 'Mantener sesión abierta';?></td>
          <td>
            <?php echo $data['sesion']; ?>
          </td>
        </tr>
        <tr>
          <td><?php echo ($data['idioma'] == 'ingles') ? "Init time" : 'Hora de inicio';?></td>
          <td>
            <?php echo $data['hora']; ?>
          </td>
        </tr>
      </table>
      <div class="space"></div>
      <a href="logout.php" class="btn btn-lg pull-right btn-warning">CERRAR SESIÓN</a>
    </div>
    <!-- /main -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>

  </html>
