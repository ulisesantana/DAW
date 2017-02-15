<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nombres guardados en sesión</title>
  <style>
  .titulo { font-family:arial; font-size: 20px; color: #0022DD; font-weight: bold; }
  .boton { height: 24px; width: 100px; border-radius:2px 2px 2px 2px;
    border:1px solid #0000FF; background: #0000DD; font-family: Arial;
    font-size: 12px; color: #FFF; text-shadow: 0 1px #aa4040;
    font-weight: bold; }
    .texto { font-family: verdana ; font-size: 14px; color: #0000DD; }
    .error { font-family: verdana ; font-size: 12px; color: red; }
    .lista { font-family: verdana; font-size: 14px; color: #000000; }
    td { color:white; font-family:verdana; font-size:12px; }
    </style>
  </head>
  <body>
    <p class="titulo"> GUARDAR NOMBRES EN SESIÓN </p>
    <p class="error"> {{ $mensaje }} </p>
    <br>

    <form action="/ejemplo/sesiones/nombresSesion" method="post">
      {{ csrf_field() }}
      <table width="300">
        <tr>
          <td><span class="texto">Nombre:</span></td>
          <td><input type="text" name="nombre" size="14" autofocus></td>
        </tr>
        <tr height="50">
          <td>
            <input type="submit" name="guardar" value="GUARDAR" class="boton" style="width: 100px;">
          </td>
          <td>
            <input type="submit" name="borrar" value="BORRAR TODOS" class="boton" style="width: 130px;">
          </td>
        </tr>
      </table>
    </form>
    <hr align="left" width="330">
    <p class="texto">Nombres guardados (ordenados y sin repetir):</p>
    <ul class="lista">
      <?php
      if ($arrayNombresSesion != "") {
        foreach($arrayNombresSesion as $nombre)
        echo "<li>".$nombre."</li>";
      }
      ?>
    </ul>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
  </html>
