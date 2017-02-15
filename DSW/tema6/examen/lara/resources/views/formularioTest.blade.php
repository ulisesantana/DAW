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
			.error { font-family: verdana ; font-size: 12px; color: red; }
      .facha{float:right;}
    </style>
	</head>
<body>
  <a class="facha" href="{{ url('logout') }}">Logout</a>
	<p class="titulo"> TEST </p>

	<hr align="left" width="340">
	<br>
  <h3>Hola {{$usuario}}, tu última nota fue un {{$nota}}%</h3>
	<form method="get" action="/test">
		{{ csrf_field() }}
		<table border="solid">
      @foreach($preguntas as $pregunta)
       <tr id="{{$pregunta->id}}">
         <td>{{$pregunta->pregunta}}</td>
         <td>
           V <input type="radio" name="respuesta{{$pregunta->id}}" value="V">
         </td>
         <td>
           F<input type="radio" name="respuesta{{$pregunta->id}}" value="F">
         </td>
       </tr>
      @endforeach
			<tr height="80">
			  <td colspan="4" align="center">
					<input type="submit" name="enviar" value="ENVIAR" class="boton" style="width: 100px;">
			  </td>
			</tr>
		</table>
	</form>

</body>
</html>
