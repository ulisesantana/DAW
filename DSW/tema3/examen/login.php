<?php
include('functions.php');
post($_SERVER['REQUEST_METHOD'],1);

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
					.principal { font-family: arial; font-size: 20px; color: #0022DD; font-weight: bold; }
					.titulo { font-family: verdana; font-size: 15px; color: #0000DD; }
					.boton { height: 30px; width: 140px; border-radius:2px 2px 2px 2px; border:1px solid #00DDEE; background: #7777FF; font-family: Arial; font-size: 12px; color: #FFF; }
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
			<p><span class="principal"> Iniciar sesión </span></p>
			<form name="login" method="post" action="">
				<table width="300" border="0" cellpadding="3" cellspacing="4">
					<tr>
						<td class="titulo">Usuario:</td>
						<td><input required name="usuario" type="text" class="boton"></td>
					</tr>
					<tr>
						<td class="titulo">Idioma:</td>
						<td>
							<select required name="idioma" class="boton">
								<option value="espanol"> Español </option>
								<option value="ingles"> Inglés </option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="titulo">Tamaño fuente:</td>
						<td>
							<select required name="tamano" class="boton">
								<option value="12"> 12 px </option>
								<option value="16"> 16 px </option>
								<option value="20"> 20 px </option>
							</select>
						</td>
					</tr>
					<tr align="center">
						<td class="titulo" colspan="2">
							<input type="checkbox" name="sesion" value="abierto"> mantener la sesión abierta
						</td>
					</tr>
					<tr></tr>
					<tr align="center">
						<td colspan="2">
							<input class="boton" name="acceder" type="submit" value="ACCEDER">
						</td>
					</tr>
				</table>
			</form>
    </div> <!-- /main -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>

</html>
