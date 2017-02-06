<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>LISTADO DE INCIDENCIAS</title>
		
		<style>
			.titulo { color:white; font-family:verdana; font-size:18px; }
			.tabla { border-collapse:collapse; border: 1px solid black; background:#77B3DD; color:white; font-family:verdana; font-size:12px; }
			td { background:#88C4EE; }
		</style>
		
		<script language="javascript" type="text/javascript">
			function filaMouseOver (fila) {
				fila.style.color = 'red';
			}
			
			function filaMouseOut (fila) {
				fila.style.color = 'white';
			}
		</script>
	</head>
<body bgcolor=#5591BB>
	<p class="titulo">INCIDENCIAS REGISTRADAS </p>
	<hr align="left" width="800">
	
	<span> <?php echo count($incidencias)." incidencias registradas";  ?> </span>
	<br><br>
	
	<table width="800" border="1" class="tabla">
		<tr height="30">
			<th width="150">Asunto</th> <th width="65">Urgente</th> <th width="65">Tipo</th> <th width="85">Fecha</th> <th width="35">Id</th> <th width="130">E-mail</th> <th>Descripción</th>
		</tr> 
		<?php
			foreach ($incidencias as $incidencia) {
				$arrayIncidencia = explode(":", $incidencia);
				echo "<tr height=\"25\" onMouseOver=\"filaMouseOver(this);\" onMouseOut=\"filaMouseOut(this);\">";
					foreach ($arrayIncidencia as $campo) {
						echo "<td>".$campo."</td>";
					}
				echo "</tr>";
			}
		?>
	</table>
	
	<br>
	<a href="{{ url('/') }}"> << VOLVER</a>
	
</body>
</html>
