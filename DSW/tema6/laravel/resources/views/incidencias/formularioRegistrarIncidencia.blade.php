<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>INCIDENCIAS</title>
		<style>
			.titulo { color:white; font-family:verdana; font-size:18px; }
			td { color:white; font-family:verdana; font-size:12px; }
		</style>
	</head>
<body bgcolor=#5591BB>
	<p class="titulo">REGISTRO DE INCIDENCIAS ON-LINE</p>
	<hr align="left" width="360">
	
	<span> {{ $mensaje }} </span>
	<br><br>
	
	<form method="get" action="/incidencias/insertar" >
		
		{{ csrf_field() }}
	
		<table width="360" border="0">
			<tr> 
				<td>Asunto:</td>
				<td><input type="text" name="asunto"> * </td>
			</tr>
			<tr> 
				<td>Urgente:</td>
				<td><input type="checkbox" name="urgente"></td>
			</tr>
			<tr> 
				<td>Tipo:</td>
				<td>
					<input type="radio" name="tipo" value="hardware">Hardware<br>
					<input type="radio" name="tipo" value="redes">Redes<br>
					<input type="radio" name="tipo" value="software">Software<br>
				</td>
			</tr>
			<tr> 
				<td>Fecha:</td> 
				<td> <input type="date" name="fecha"> </td>
			</tr>
			<tr> 
				<td>Identificador:</td>
				<td> <input type="number" name="identificador" min="1"> </td>
			</tr>
			<tr>
				<td>E-mail de contacto:</td>
				<td> <input type="email" name="email"> </td> 
			</tr>
			<tr> 
				<td>Descripción:</td>
				<td> <textarea name="descripcion" rows="6" cols="21"></textarea> </td>
			</tr>
			<tr>
				<td colspan="2" align="center" height="50"> <input type="submit" name="submit" value="INSERTAR INCIDENCIA"> </td>
			</tr>
		</table>
	</form>
	
	<hr align="left" width="360">
	
	<form method="get" action="/incidencias/listar">
			
		{{ csrf_field() }}
		
		<table width="360" border="0">
			<tr>
				<td align="center" height="50"> <input type="submit" name="submit" value="LISTAR INCIDENCIAS"> </td>
			</tr>
		</table>
	</form>	
	
	<hr align="left" width="360">
	
	<form method="get" action="/incidencias/buscar">
			
		{{ csrf_field() }}
		
		<table width="360" border="0">
			<tr>
				<td height="50" width="50"> Asunto: </td>
				<td height="50" width="100"> <input type="text" name="asunto" size="14"> </td>
				<td height="50" width="200"> <input type="submit" name="submit" value="BUSCAR INCIDENCIAS"> </td>
			</tr>
		</table>
	</form>	
	
	<hr align="left" width="360">	

	<form method="get" action="/incidencias/eliminar">
			
		{{ csrf_field() }}
		
		<table width="360" border="0">
			<tr>
				<td height="50" width="100"> Identificador: </td>
				<td height="50" width="240"> <input type="text" name="identificador" size="4"> </td>
				<td height="50" width="200"> <input type="submit" name="submit" value="ELIMINAR INCIDENCIA"> </td>
			</tr>
		</table>
	</form>		
	
</body>
</html>
