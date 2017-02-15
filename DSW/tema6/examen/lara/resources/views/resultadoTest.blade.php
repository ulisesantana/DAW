<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>TEST</title>
		<style>
			.titulo { font-family:arial; font-size: 20px; color: #0022DD; font-weight: bold; }
			.boton { height: 24px; width: 100px; border-radius:2px 2px 2px 2px;
				    border:1px solid #0000FF; background: #0000DD; font-family: Arial;
				    font-size: 12px; color: #FFF; text-shadow: 0 1px #aa4040;
				    font-weight: bold; }
			.texto { font-family: verdana ; font-size: 14px; color: #0000DD; }
			.respuesta { font-family: verdana ; font-size: 14px; color: #000000; }
		</style>
	</head>
<body>
	<p class="titulo"> RESULTADO </p>
	<hr align="left" width="300">
  <p>
    Aciertos: {{ $aciertos }}
  </p>
  <p>
    Porcentaje: {{ $porcentaje }}
  </p>
	<br>
  <a href="{{ url('/') }}">Volver</a>




</body>
</html>
