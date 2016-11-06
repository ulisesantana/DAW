<?php
$cookie_name = 'login';
$cookie_value = 'Dame fuerte papi!!';
$cookie_expiration_date = time()+30; //En segundos (86400s = 1 día)
$cookie_destination = '/';
setcookie($cookie_name, $cookie_value, $cookie_expiration_date, $cookie_destination);

//Las cookies siempre se ponen al principio del documento,
//antes incluso del !DOCTYPE html
 ?>
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
                <input required type="text" name="pass"><br>
              </div>
            </div>
          <input class="btn btn-success center-block" type="submit" value="Acceder">
        </form>

        <form id="news" style="display:none" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        </form>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <?php
      include('functions.php');
      $login = false;
      if ( !$login && $_SERVER['REQUEST_METHOD'] == "POST" ) {
        $user = (isset($_POST['user'])) ? $_POST['user'] : null;
        $pass = (isset($_POST['pass'])) ? $_POST['pass'] : null;
        $auth = $user.'#'.$pass;
        login($auth);
        // newNews();
      }

      if( $login && ($_SERVER['REQUEST_METHOD'] == "POST") ){
        $x = (isset($_POST['x']) && $_POST['x']>=0) ? $_POST['x'] : null;
        $y = (isset($_POST['y']) && $_POST['y']>=0) ? $_POST['y'] : null;
        $ancho = (isset($_POST['ancho']) && $_POST['ancho']>=250) ? $_POST['ancho'].'px' : null;
        $alto = (isset($_POST['alto']) && $_POST['alto']>=150) ? $_POST['alto'].'px' : null;
        $color_text = (isset($_POST['color-text'])) ? $_POST['color-text'] : null;
        $text_size = (isset($_POST['text-size']) && $_POST['text-size']>=0) ? $_POST['text-size'] : null;
        $text = (isset($_POST['text']) && strlen($_POST['text'])>=0) ? $_POST['text'] : null;
        $typo = (isset($_POST['typo'])) ? $_POST['typo'] : null;

        echo $typo;
      }
     ?>
  </body>
</html>
