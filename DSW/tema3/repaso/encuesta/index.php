<?php
include('functions.php');

post($_SERVER['REQUEST_METHOD']);

$encuesta = (isset($_SESSION['encuesta'])) ? $_SESSION['encuesta'] : null;
$si = (!is_null($encuesta)) ? round(($encuesta['si']/$encuesta['total'])*100, 2) : null;
$no = (!is_null($encuesta)) ? round(($encuesta['no']/$encuesta['total'])*100, 2) : null;


print_r($encuesta);
?>
  <!DOCTYPE html>
  <html lang="es">

  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Encuesta toda loca</title>

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
            <a href="#"></a>
          </li>
        </ul>
      </div>
    </div>
    <!-- /profile -->

    <div id="main">
      <h2 class="text-center">¿Estás de acuerdo con...?</h2>

      <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="row">
          <div class="space"></div>
          <div class="col-md-9">
            <div class="progress">
              <div class="progress-bar progress-bar-success" role="progressbar"
                aria-valuenow="<?php echo $si; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $si; ?>%;">
                <?php echo $si; ?>%
              </div>
            </div>
          </div>
          <input class="btn btn-success col-md-2 col-md-offset-1" type="submit" name="voto" value="SI">
        </div>

        <div class="row">
          <div class="space"></div>
          <div class="col-md-9">
            <div class="progress">
              <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="<?php echo $no; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $no; ?>%;">
                <?php echo $no; ?>%
              </div>
            </div>
          </div>
          <input class="btn btn-danger col-md-2 col-md-offset-1" type="submit" name="voto" value="NO">
        </div>
      </form>

    </div>
    <!-- /main -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>

  </html>
