<?php

function justificarLinea (&$linea, $cuantosEspacios) {
	for ($i = 0; $i < $cuantosEspacios; $i++)
		$linea = " " . $linea;	
}

if (file_exists("texto.txt")) {
	
	// Abre el archivo de texto para calcular la longitud de la línea más larga:
	
	$longitudMax = 0;
	$fichero = fopen("texto.txt", "r");
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
	
	$ficheroEntrada = fopen("texto.txt", "r");
	$ficheroSalida = fopen("texto_justificado.txt", "w+");
	
	while (!feof($ficheroEntrada)){
		$linea = fgets($ficheroEntrada);
		$longitud = strlen($linea);
		
		if (!feof($ficheroEntrada))
			$longitud -= 2;

		$cuantosEspacios = $longitudMax - $longitud;		
		justificarLinea($linea, $cuantosEspacios);
		
		fputs($ficheroSalida, $linea);
	}
	fclose($ficheroEntrada);
	fclose($ficheroSalida);
	
	

    // Muestra el contenido de ambos archivos:
	
	echo "<H2>Contenido del fichero sin justificar:</H2>";
	// leemos el fichero y lo guardamos en un array
	$arrayLineasDelFichero = file("texto.txt");
	// imprime el contenido del array:
	echo "<pre>";
	foreach($arrayLineasDelFichero as $linea)
		echo $linea;
	echo "</pre>";

	echo "<br><H2>Contenido del fichero justificado:</H2>";
	// leemos el fichero y lo guardamos en un array
	$arrayLineasDelFichero = file("texto_justificado.txt");
	// imprime el contenido del array:
	echo "<pre>";
	foreach($arrayLineasDelFichero as $linea) {
		echo $linea;
	}
	echo "</pre>";
	
} else
	echo "El fichero no existe";

?>
