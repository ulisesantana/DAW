<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sesiones</title>


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
    </div>

    <div id="main">

      <h1>Mi web</h1>

      <form id="session" method="post" action="/sesiones/profile">
        {{ csrf_field() }}
        Nombre: <input required name="name" type="text"
                  value="<?php if(!is_null($config['name'])) echo $config['name']; ?>">

        <select required name="bg">
          <option value="" disabled <?php if(is_null($config['bg'])) echo 'selected'; ?> >
            Elige un color
          </option>
          <option style="color:aqua;" value="aqua"
            <?php if($config['bg'] == 'aqua') echo 'selected'; ?> >
            Azul
          </option>
          <option style="color:red;"value="red"
            <?php if($config['bg'] == 'red') echo 'selected'; ?> >
            Rojo
          </option>
          <option style="color:green;"value="green"
            <?php if($config['bg'] == 'green') echo 'selected'; ?> >
            Verde
          </option>
        </select>

        <select required name="lang">
          <option value="" disabled
            <?php if(is_null($config['lang'])) echo 'selected'; ?> >
            Elige un idioma
          </option>
          <option value="es" <?php if($config['lang'] == 'es') echo 'selected'; ?> >
            Español
          </option>
          <option value="en" <?php if($config['lang'] == 'en') echo 'selected'; ?> >
            Inglés
          </option>
        </select>
        <input type="submit" class="btn btn-info" value="ACCEDER">
      </form>

    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>
