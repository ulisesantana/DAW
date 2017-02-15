<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>INICIAR SESIÓN</title>
		<style>
			.titulo { font-family:arial; font-size: 20px; color: #0022DD; font-weight: bold; }
			.boton { height: 24px; width: 100px; border-radius:2px 2px 2px 2px;
				    border:1px solid #0000FF; background: #0000DD; font-family: Arial;
				    font-size: 12px; color: #FFF; text-shadow: 0 1px #aa4040;
				    font-weight: bold; }
			.texto { font-family: verdana ; font-size: 14px; color: #0000DD; }
			.error { font-family: verdana ; font-size: 12px; color: red; }
		</style>
	</head>
<body>
	<p class="titulo"> INICIAR SESIÓN </p>

	<form method="post" action="/login">
		{{ csrf_field() }}
		<table width="300">
			<tr>
			  <td><span class="texto">Usuario:</span></td>
			  <td><input type="text" name="usuario" size="14"></td>
			</tr>
			<tr>
			  <td><span class="texto">Clave:</span></td>
			  <td><input type="password" name="clave" size="14"></td>
			</tr>
			<tr height="60">
			  <td colspan="2" align="center">
				<input type="submit" name="iniciar" value="INICIAR" class="boton" style="width: 100px;">
			  </td>
			</tr>
		</table>
	</form>
	<hr align="left" width="330">
	<p class="error"> {{ $mensaje }} </p>
	<br>

</body>
</html>
