<?php
include('functions.php');
if (isset($_COOKIE['login'])) {
  $aux = $_COOKIE['login'];
  if(!login($aux)){
    header('Location: login.php');
  }
} else {
  header('Location: login.php');
}
 ?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tablón de Anuncios - Añadir noticia</title>

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
      $alert='';
      $userAlert='';
      $error='';

      //Entra en el if si se enviado el formulario de noticias
      if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['form'] == 'noticia'){
        $noticia = [ //Inicializamos todo a null para el checker
          'x' => null,
          'y' => null,
          'ancho' => null,
          'alto' => null,
          'color-text' => null,
          'text-size' => null,
          'text' => null,
          'color-news' => null,
          'typo' => null
        ];

        if (isset($_POST['x']) && $_POST['x']>=0){
          $noticia['x'] = $_POST['x'];
        } else {
          $error .= 'El eje X debe ser mayor a 0.<br>';
        }

        if (isset($_POST['y']) && $_POST['y']>=0){
          $noticia['y'] = $_POST['y'];
        } else {
          $error .= 'El eje Y debe ser mayor a 0.<br>';
        }

        if (isset($_POST['ancho']) && $_POST['ancho']>=250){
          $noticia['ancho'] = $_POST['ancho'];
        } else{
          $error .= 'El ancho debe ser mayor o igual a 250.<br>';
        }

        if (isset($_POST['alto']) && $_POST['alto']>=150){
          $noticia['alto'] = $_POST['alto'];
        } else{
          $error .= 'El alto debe ser mayor a 150.<br>';
        }

        if (isset($_POST['color-text'])){
          $noticia['color-text'] = $_POST['color-text'];
        } else{
          $error .= 'Debes seleccionar un color para el texto.';
        }

        if (isset($_POST['text-size']) && $_POST['text-size']>=0){
          $noticia['text-size'] = $_POST['text-size'];
        } else{
          $error .= 'El tamaño del texto debe ser mayor a 0.<br>';
        }

        if (isset($_POST['text']) && strlen($_POST['text'])>=0){
          $noticia['text'] = $_POST['text'];
        } else{
          $error .= 'Tienes que escribir algo en la noticia.';
        }

        if (isset($_POST['color-news'])){
          $noticia['color-news'] = $_POST['color-news'];
        } else{
          $error .= 'Debes seleccionar un color para el fondo de la noticia.';
        }

        if (isset($_POST['typo'])){
          $noticia['typo'] = $_POST['typo'];
        } else{
          $error .= 'Debes seleccionar una tipografía.<br>';
        }

        if (checkValues($noticia)) {
          //Actualizamos noticia
          updateXML($noticia);
          $alert = '
            <div id="error" class="alert alert-success">
              Tu noticia se ha publicado con éxito. Puedes añadir más si quieres.
            </div>';

        } else {
          //Bloque que muestra los errores del formulario
          $alert = '
            <div id="error" class="alert alert-danger">'
            .$error.
            '</div>';
        }

      } elseif ($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['form'] == 'usuarios'){
        //Ejecución del formulario para añadir usuarios
        $user = (isset($_POST['user'])) ? $_POST['user'] : null;
        $pass = (isset($_POST['pass'])) ? $_POST['pass'] : null;
        $auth = $user.'-'.$pass;

        if(userChecker($user) && strlen($user)>3){
          $userAlert = addUsers($auth);
        } else{
          $userAlert = '
          <div id="error" class="alert alert-danger">
          La contraseña o el usuario no son válidos.
          </div>';
        }


      }
     ?>

      <div class="row">

        <div class="col-md-6">
          <?php echo $alert; ?>
          <form id="news" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <h3 class="text-center">Añadir una noticia</h3>
            <div class="row">
              <div class="col-md-4">
                <label>Eje X: </label>
              </div>
              <div class="col-md-8">
                <input required type="text" name="x" placeholder="Mayor a cero">
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <label>Eje Y: </label>
              </div>
              <div class="col-md-8">
                <input required type="text" name="y" placeholder="Mayor a cero">
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <label>Ancho: </label>
              </div>
              <div class="col-md-8">
                <input required type="text" name="ancho" placeholder="Mayor o igual a 250">
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <label>Alto: </label>
              </div>
              <div class="col-md-8">
                <input required type="text" name="alto" placeholder="Mayor o igual a 160">
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <label>Color del texto: </label>
              </div>
              <div class="col-md-8">
                <input required type="color" name="color-text">
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <label>Tamaño del texto: </label>
              </div>
              <div class="col-md-8">
                <input required type="text" name="text-size" placeholder="Mayor a cero">
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <label>Texto de noticia: </label>
              </div>
              <div class="col-md-8">
                <input required type="text" name="text" placeholder="Escribe tu noticia">
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <label>Color de la noticia: </label>
              </div>
              <div class="col-md-8">
                <input required type="color" name="color-news">
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <label>Tipografía: </label>
              </div>
              <div class="col-md-8">
                <select required name="typo">
                  <option selected="true" disabled="disabled">Selecciona una tipografía</option>
                  <option value="Handlee">Handlee</option>
                  <option value="Arial">Arial</option>
                  <option value="Times New Roman">Times New Roman</option>
                </select>
              </div>
            </div>
            <input type="hidden" name="form" value="noticia">
          <input class="btn btn-success center-block" type="submit" name="submit" value="Añadir Noticia">
          </form>
          <?php echo $alert; ?>
        </div>

        <div class="col-md-6">

          <form id="users" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <h3 class="text-center">Añadir a usuarios</h1>
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
                  <input required type="password" name="pass" placeholder="Mínimo 4 caracteres"><br>
                </div>
              </div>
              <input type="hidden" name="form" value="usuario">
            <input class="btn btn-success center-block" type="submit" name="submit" value="Añadir Usuario">
          </form>

          <?php echo $userAlert; ?>
        </div>

      </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  </body>
</html>
