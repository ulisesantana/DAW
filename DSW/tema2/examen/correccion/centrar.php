<!-- VALIDACIÓN DEL FORMULARIO -->
<?php
	$errorValidacion = "";
	$validacionOK = true;
	   
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (empty($_FILES['fichero']['name'])) {
			$validacionOK = false;
			$errorValidacion .= "<br>Debe especificar un fichero a subir.";
		} else {
			$tamaño = $_FILES['fichero']['size'];
			if ($tamaño > 32000 || $tamaño == 0) {  // tamaño máximo 32 KB = 32000 B
				$validacionOK = false;
				$errorValidacion .= "El tamaño ".$tamaño." excede el límite de 32 KB permitido.";
			}
			$tipo = $_FILES['fichero']['type'];
			if ($tipo != "text/plain" ) {  
				$validacionOK = false;
				$errorValidacion .= "El archivo indicado debe contener texto plano (.txt).";
			}
		}
	}
?>

<!DOCTYPE html>
<html>
    <head>
		<title>Centrar texto</title>
		
		<style>
			.principal { font-family: arial; font-size: 20px; color: #0022DD; font-weight: bold; }
			.titulo { font-family: verdana; font-size: 15px; color: #0000DD; }
			.parrafo { font-family: arial; font-size: 12px; color: #0000DD; }
			.boton { height: 30px; width: 140px; border-radius:2px 2px 2px 2px; border:1px solid #00DDEE; background: #0000DD; font-family: Arial; font-size: 12px; color: #FFF; text-shadow: 0 1px #aa4040; font-weight: bold; }
		</style>
	</head>
<body> 	
	<p><span class="principal">
		CENTRAR TEXTO ONLINE
	</span></p> 
	
	<form enctype="multipart/form-data" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
	<table>
	<tr>
	  <td><span class="titulo">Fichero:</span></td> 
	  <td><input type="file" name="fichero" style="height: 20px; border:1px solid #0000FF; font-family: Arial; font-size: 12px; color: #0000FF;"> <?php echo $errorValidacion; ?></td>
	</tr>
    </table>
	<br>
	<input type="submit" name="enviar" value="SUBIR y CENTRAR" class="boton">
	</form>
	<hr>

<!-- FICHERO SUBIDO CON EL FORMULARIO -->
	<?php
		function centrarLinea (&$linea, $cuantosEspacios) {
			$cuantosEspacios = (int)$cuantosEspacios/2;
			// se añade la mitad de espacios por delante para centrarlo
			for ($i = 0; $i < $cuantosEspacios; $i++)
				$linea = " " . $linea;	
		}
	
	
	    if ($_SERVER["REQUEST_METHOD"] == "POST" && $validacionOK == true) {
			// Copia el archivo a la carpeta de destino y borra el archivo temporal
			$nombreTmp = $_FILES['fichero']['tmp_name']; 
			$nombreDef = $_FILES['fichero']['name'];
			$resultado = copy($nombreTmp,$nombreDef);
			if ($resultado == 0) {
				unlink($nombreTmp);
			}
				
			echo "<p class=\"parrafo\"> Fichero subido correctamente. </p>";
			
			// Abre el archivo de texto para calcular la longitud de la línea más larga			
			$longitudMax = 0;
			$fichero = fopen($nombreDef, "r");
			while (!feof($fichero)){
				$linea = fgets($fichero);
				$longitud = strlen($linea);
				
				if (!feof($fichero))
					$longitud -= 2;
				
				if ($longitud > $longitudMax)
					$longitudMax = $longitud;
			}
			fclose($fichero);
			
			//echo "<br>".$longitudMax;
			
			// Abre los dos archivos: lee de uno, justifica la línea y la escribe en el otro:
			
			$ficheroEntrada = fopen($nombreDef, "r");
			$ficheroSalida = fopen($nombreDef."_centrado.txt", "w+");
			
			while (!feof($ficheroEntrada)){
				$linea = fgets($ficheroEntrada);
				$longitud = strlen($linea);
				
				if (!feof($ficheroEntrada))
					$longitud -= 2;

				$cuantosEspacios = $longitudMax - $longitud;		
				centrarLinea($linea, $cuantosEspacios);
				
				fputs($ficheroSalida, $linea);
			}
			fclose($ficheroEntrada);
			fclose($ficheroSalida);

			// Muestra el contenido de ambos archivos:

			echo "<br> <p class=\"titulo\">Contenido del fichero ".$nombreDef." sin centrar:</p>";
			// leemos el fichero y lo guardamos en un array
			$arrayLineasDelFichero = file($nombreDef);
			// imprime el contenido del array en un textarea:
			echo "<textarea rows=\"8\" cols=\"44\" readonly>";
				foreach($arrayLineasDelFichero as $linea)
					echo $linea;
			echo "</textarea>";

			echo "<br><p class=\"titulo\">Contenido del fichero ".$nombreDef." centrado:</p>";
			// leemos el fichero y lo guardamos en un array
			$arrayLineasDelFichero = file($nombreDef."_centrado.txt");
			// imprime el contenido del array:
			echo "<textarea rows=\"8\" cols=\"44\" readonly>";
				foreach($arrayLineasDelFichero as $linea)
					echo $linea;
			echo "</textarea>";
		
			// Enlace de descarga
			echo "<br><br>";
			echo "<a class=\"boton\" href=\"".$nombreDef."_centrado.txt"."\">DESCARGAR ARCHIVO ".$nombreDef." CENTRADO</a>";
		}
	?>
</body>
</html>
