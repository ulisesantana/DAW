<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Repaso - Ejercicio 1</title>


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
              <li class="active"><a href="ejercicio1.php">Ejercicio 1 - Subida de Ficheros</a></li>
              <li><a href="ejercicio2.php">Ejercicio 2 - XML</a></li>
              <li><a href="ejercicio3.php">Ejercicio 3 - Cookies</a></li>
            </ul>
        </div>
    </div>


    <div id="main">
      <h2 class="text-center">Subida de ficheros al servidor</h2>
      <p>Sólo se pueden subir ficheros de hasta 10MB</p>

      <form enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
        <!-- MAX_FILE_SIZE debe preceder al campo de entrada del fichero -->
        <input type="hidden" name="MAX_FILE_SIZE" value="102400" />
        <label for="upload">Fichero:</label><input type="file" name="upload">
        <br>
        <label for="directory">Diretorio del servidor: </label>
        <select name="directory" >
          <option value="img">Imágenes</option>
          <option value="docs">Documentación</option>
        </select>
        <div class="space"></div>
        <input class="btn btn-info center-block" type="submit" name="submit" value="SUBIR">
      </form>

      <hr>

      <?php
      if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($_FILES['upload']['name'])) {
        // Copia el archivo temporal a la carpeta de destino
        $dir = "./".$_POST['directory'].'/';
        $fileName = $_FILES['upload']['name'];
        $file = $dir.$fileName;

        if (!is_dir($dir)) mkdir($dir);

        if (move_uploaded_file($_FILES['upload']['tmp_name'], $file)) {
          // Crea el archivo .zip dentro de la carpeta de destino
          $zip = $file.".zip";
          $zipFile = new ZipArchive;
          if ($zipFile->open($zip, ZipArchive::CREATE) !== true) exit("No se puede crear el archivo".$zipFile);
          // Añade el archivo al .zip
          $zipFile->addFile($file);
          // se puede añadir más archivos al mismo .zip: $zipFile->addFile(otro,otro);
          // Cierra el archivo .zip
          $zipFile->close();
          // Borra el archivo original subido para dejar solo el comprimido
          unlink($file);
          // Lista el directorio de Destino con todos los .zip
          echo "<h3>Listado de archivos subidos al servidor:</h3>";
          $fileList = scandir($dir);

          for ($i = 2; $i < count($fileList); $i++) {
            $fileItem = $fileList[$i];
            echo $fileItem . "<br>";
          }
        } else {
          echo "¡Posible ataque de subida de ficheros!\n";
        }

      }
      ?>
    </div>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>


</html>
