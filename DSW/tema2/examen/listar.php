<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catálogo de Portátiles</title>


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

        .principal { font-family: arial; font-size: 20px; color: #0022DD; font-weight: bold; }
  			.titulo { font-family: verdana; font-size: 15px; color: #0000DD; }
  			.parrafo { font-family: arial; font-size: 12px; color: #0000DD; }
  			.boton { height: 30px; width: 145px; border-radius:2px 2px 2px 2px; border:1px solid #00DDEE; background: #0088DD; font-family: Arial; font-size: 12px; color: #FFF; text-shadow: 0 1px #aa4040; font-weight: bold; }
  			/*td { font-family: arial; font-size: 14px; color: #0000DD; }*/
  			th { font-family: verdana; font-size: 16px; color: #0088DD; }
  			.resaltado { font-family: verdana; font-size: 14px; color: #00EE55; font-weight: bold; }
    </style>
</head>


<body>


    <div id="profile">
        <img src="https://avatars3.githubusercontent.com/u/17091490?v=3&s=466" alt="" class="img-responsive img-circle">
        <h3 class="text-center">Ulises Santana Suárez <br><small>2º DAW</small></h3>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav">
              <li><a href="centrar.php">Centrar</a></li>
              <li class="active"><a href="listar.php">Listar</a></li>
            </ul>
        </div>
    </div>


    <div id="main">
      <p><span class="principal">
    		CATÁLOGO DE PORTÁTILES
    	</span></p>

    	<table class="titulo" style="border: 1px solid black;" border="0" cellpadding="10">
    		<tr>
    		<td>
    		<form name="buscar_por_marca" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
    		  Marca: <input type="text" name="marca" value="" size="14" required>
    		  <br><br>
    		  <input type="hidden" name="form" value="marca">
    		  <input type="submit" name="submit" value="BUSCAR por MARCA" class="boton">
    		</form>
    		</td>

    		<td>
    		<form name="buscar_por_precio" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
    		  Precio menor que: <input type="number" name="precio" min="1" max="999" value="" required style="width: 8em;">
    		  <br><br>
    		  <input type="hidden" name="form" value="precio">
    		  <input type="submit" name="submit" value="BUSCAR por PRECIO" class="boton">
    		</form>
    		</td>
    		</tr>
    	</table>
    	<br>

      <?php
      libxml_use_internal_errors(true);
      $catalogo = simplexml_load_file("assets/portatiles.xml");
      $form = (isset($_POST['form'])) ? $_POST['form'] : '';

      if ($catalogo === false) echo "Error en el archivo XML";

      if ($_SERVER['REQUEST_METHOD'] == "POST" && $form == 'precio'){
          $i=0;
          foreach ($catalogo->Portatil as $laptop) {
            if ($laptop->Precio < $_POST['precio']){
            $laptops[$i] = [
              'marca' => $laptop->Marca,
              'procesador' => $laptop->Procesador,
              'ram' => $laptop->RAM,
              'disco' => $laptop->Disco,
              'precio' => $laptop->Precio
            ];
            $i++;
          }
        }
      } else{
        $i=0;
        foreach ($catalogo->Portatil as $laptop) {
            $laptops[$i] = [
            'marca' => $laptop->Marca,
            'procesador' => $laptop->Procesador,
            'ram' => $laptop->RAM,
            'disco' => $laptop->Disco,
            'precio' => $laptop->Precio
            ];
            $i++;
        }
      }

        ?>

      	<table class="table">
          <?php
          if (!empty($laptops)){
            echo '<th></th><th>Marca</th><th>Procesador</th><th>RAM</th><th>HDD</th><th>Precio</th>';
            foreach ($laptops as $laptop) {
              if ($form == 'marca' && ($laptop['marca'] == strtoupper($_POST['marca'])) ) {
                echo '
                <tr class="text-info">
                  <td><input type="checkbox"></td>
                  <td>'.$laptop['marca'].'</td>
                  <td>'.$laptop['procesador'].'</td>
                  <td>'.$laptop['ram'].'</td>
                  <td>'.$laptop['disco'].'</td>
                  <td>'.$laptop['precio'].'</td>
                </tr>';
              }
              else {
                echo '
                <tr>
                <td><input type="checkbox"></td>
                <td>'.$laptop['marca'].'</td>
                <td>'.$laptop['procesador'].'</td>
                <td>'.$laptop['ram'].'</td>
                <td>'.$laptop['disco'].'</td>
                <td>'.$laptop['precio'].'</td>
                </tr>';
              }
            }
          } else {
            echo "La consulta solicitada no coincide.";
          }
          ?>
       </table>




    	<br>
    	<form name="guardar" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
    		<input type="hidden" name="form" value="guardar">
    		<input type="submit" name="submit" value="GUARDAR" class="boton">
    	</form>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>


</html>
