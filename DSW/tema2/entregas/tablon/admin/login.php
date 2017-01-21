<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tablón de Anuncios - Login</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="styles.css" media="screen" title="no title" charset="utf-8">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
  <body>
    <?php
    include('functions.php');
    $alert = '';
    if ( $_SERVER['REQUEST_METHOD'] == "POST" ) {
      $user = (isset($_POST['user'])) ? $_POST['user'] : null;
      $pass = (isset($_POST['pass'])) ? $_POST['pass'] : null;
      $auth = $user.'#'.$pass;
      if(login($auth)){
        setLogin($auth);
        header('Location: index.php');
      } else{
        $alert = '
        <div id="error" class="alert alert-danger">
          Usuario y contraseña incorrectos,
          ¿por qué no pruebas con <i>admin</i> y <i>1234</i>?
        </div>';
      }
    }

    ?>

        <form id="login" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
          <h3 class="text-center">Acceso a usuarios</h1>
            <div class="row">
              <div class="col-md-4">
                <label>Usuario: </label>
              </div>
              <div class="col-md-8">
                <input required type="text" name="user">
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <label>Contraseña: </label>
              </div>
              <div class="col-md-8">
                <input required type="password" name="pass"><br>
              </div>
            </div>
          <input class="btn btn-success center-block" type="submit" value="Acceder">
        </form>

        <?php echo $alert; ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
