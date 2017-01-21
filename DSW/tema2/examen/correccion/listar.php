<?php
	$seleccionados = "";

	if (isset($_COOKIE['seleccionados'])) { // lee la cookie si existe
		$seleccionados = $_COOKIE['seleccionados']; // es una string con todos las posiciones de los seleccionados
	}

	$marca = $precio = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['marca']))
			$marca = $_POST['marca'];
		if (isset($_POST['precio']))
			$precio = $_POST['precio'];
	}

	libxml_use_internal_errors(true);
	$Portatiles = simplexml_load_file("portatiles.xml") or die("No se encuentra el archivo .xml");
	if ($Portatiles === false)
		echo "Error en el archivo XML";
?>

<!DOCTYPE html>
<html>
    <head>
		<title>Catálogo de Portátiles</title>
		<style>
			.principal { font-family: arial; font-size: 20px; color: #0022DD; font-weight: bold; }
			.titulo { font-family: verdana; font-size: 15px; color: #0000DD; }
			.parrafo { font-family: arial; font-size: 12px; color: #0000DD; }
			.boton { height: 30px; width: 145px; border-radius:2px 2px 2px 2px; border:1px solid #00DDEE; background: #0088DD; font-family: Arial; font-size: 12px; color: #FFF; text-shadow: 0 1px #aa4040; font-weight: bold; }
			td { font-family: arial; font-size: 14px; color: #0000DD; }
			th { font-family: verdana; font-size: 16px; color: #0088DD; }
			.resaltado { font-family: verdana; font-size: 14px; color: #00EE55; font-weight: bold; }
		</style>
	</head>
<body>
	<p><span class="principal">
		CATÁLOGO DE PORTÁTILES
	</span></p>

	<table class="titulo" style="border: 1px solid black;" border="0" cellpadding="10">
		<tr>
		<td>
		<form name="buscar_por_marca" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		  Marca: <input type="text" name="marca" value="<?php echo $marca;?>" size="14" required>
		  <br><br>
		  <input type="hidden" name="tipo_formulario" value="marca">
		  <input type="submit" name="submit" value="BUSCAR por MARCA" class="boton">
		</form>
		</td>

		<td>
		<form name="buscar_por_precio" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
		  Precio menor que: <input type="number" name="precio" min="1" max="999" value="<?php echo $precio;?>" required style="width: 8em;">
		  <br><br>
		  <input type="hidden" name="tipo_formulario" value="precio">
		  <input type="submit" name="submit" value="BUSCAR por PRECIO" class="boton">
		</form>
		</td>
		</tr>
	</table>
	<br>

	<?php
	    if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$tipoFormulario = $_POST['tipo_formulario'];

			if ($tipoFormulario == "marca") {
				$marca = strtoupper($_POST['marca']);

				echo "<form method=\"post\" action=\"".htmlspecialchars($_SERVER['PHP_SELF'])."\">";
				echo "<table class=\"titulo\" style=\"border: 1px solid black;\" border=\"0\" cellpadding=\"10\">";
				echo "<tr><th> </th><th>Marca</th><th>Procesador</th><th>RAM</th><th>Disco</th><th>Precio</th></tr>";

					for ($i = 0; $i < count($Portatiles->Portatil); $i++) {
						$Portatil = $Portatiles->Portatil[$i];
						echo "<tr><td>";
							if (strpos($seleccionados, (string)$i) !== false) {
								$seleccionado = "checked";
							} else {
								$seleccionado = "";
							}
							echo "<input type=\"checkbox\" name=\"seleccionados[]\" value=\"".$i."\" ".$seleccionado.">";
						echo "</td><td>";
							if (strtoupper($Portatil->Marca) == $marca)
								echo "<span class=\"resaltado\">";
							echo $Portatil->Marca;
							if (strtoupper($Portatil->Marca) == $marca)
								echo "</span>";
						echo "</td><td>";
							if (strtoupper($Portatil->Marca) == $marca)
								echo "<span class=\"resaltado\">";
							echo $Portatil->Procesador;
							if (strtoupper($Portatil->Marca) == $marca)
								echo "</span>";
						echo "</td><td>";
							if (strtoupper($Portatil->Marca) == $marca)
								echo "<span class=\"resaltado\">";
							echo $Portatil->RAM;
							if (strtoupper($Portatil->Marca) == $marca)
								echo "</span>";
						echo "</td><td>";
							if (strtoupper($Portatil->Marca) == $marca)
								echo "<span class=\"resaltado\">";
							echo $Portatil->Disco;
							if (strtoupper($Portatil->Marca) == $marca)
								echo "</span>";
						echo "</td><td>";
							if (strtoupper($Portatil->Marca) == $marca)
								echo "<span class=\"resaltado\">";
							echo $Portatil->Precio;
							if (strtoupper($Portatil->Marca) == $marca)
								echo "</span>";
						echo "</td></tr>";
					}
				echo "</table>";
				echo "<br>";
				echo "<input type=\"hidden\" name=\"tipo_formulario\" value=\"guardar\">";
				echo "<input type=\"submit\" name=\"submit\" value=\"GUARDAR\" class=\"boton\">";
				echo "</form>";
			}

			if ($tipoFormulario == "precio") {
				$precio = $_POST['precio']."€";

				echo "<form method=\"post\" action=\"".htmlspecialchars($_SERVER['PHP_SELF'])."\">";
				echo "<table class=\"titulo\" style=\"border: 1px solid black;\" border=\"0\" cellpadding=\"10\">";
				echo "<tr><th> </th><th>Marca</th><th>Procesador</th><th>RAM</th><th>Disco</th><th>Precio</th></tr>";

					for ($i = 0; $i < count($Portatiles->Portatil); $i++) {
						$Portatil = $Portatiles->Portatil[$i];
						if ($Portatil->Precio < $precio) {
							echo "<tr><td>";
								if (strpos($seleccionados, (string)$i) !== false) {
									$seleccionado = "checked";
								} else {
									$seleccionado = "";
								}
								echo "<input type=\"checkbox\" name=\"seleccionados[]\" value=\"".$i."\" ".$seleccionado.">";
							echo "</td><td>";
								echo $Portatil->Marca;
							echo "</td><td>";
								echo $Portatil->Procesador;
							echo "</td><td>";
								echo $Portatil->RAM;
							echo "</td><td>";
								echo $Portatil->Disco;
							echo "</td><td>";
								echo $Portatil->Precio;
							echo "</td></tr>";
						}
					}
				echo "</table>";
				echo "<br>";
				echo "<input type=\"hidden\" name=\"tipo_formulario\" value=\"guardar\">";
				echo "<input type=\"submit\" name=\"submit\" value=\"GUARDAR\" class=\"boton\">";
				echo "</form>";
			}


			if ($tipoFormulario == "guardar") {
				if (isset($_POST['seleccionados'])) {
					//print_r($_POST['seleccionados']);
					$seleccionados = $_POST['seleccionados'];
					$valor = "";
					// guarda todos los precios en una string y en una única cookie:
					foreach($seleccionados as $pos) {
						$valor .= "#".$pos;
					}
					setcookie("seleccionados", $valor, time() + 30*24*60*60, "/");
					// recargamos la web:
					header("Location: ".htmlspecialchars($_SERVER['PHP_SELF']));
				}
			}

		} else {


			echo "<form method=\"post\" action=\"".htmlspecialchars($_SERVER['PHP_SELF'])."\">";
			echo "<table class=\"titulo\" style=\"border: 1px solid black;\" border=\"0\" cellpadding=\"10\">";
			echo "<tr><th> </th><th>Marca</th><th>Procesador</th><th>RAM</th><th>Disco</th><th>Precio</th></tr>";
				for ($i = 0; $i < count($Portatiles->Portatil); $i++) {
					$Portatil = $Portatiles->Portatil[$i];
					echo "<tr><td>";
						if (strpos($seleccionados, (string)$i) !== false) {
							$seleccionado = "checked";
						} else {
							$seleccionado = "";
						}
						echo "<input type=\"checkbox\" name=\"seleccionados[]\" value=\"".$i."\" ".$seleccionado.">";
					echo "</td><td>";
						echo $Portatil->Marca;
					echo "</td><td>";
					echo $Portatil->Procesador;
						echo "</td><td>";
					echo $Portatil->RAM;
					echo "</td><td>";
						echo $Portatil->Disco;
					echo "</td><td>";
						echo $Portatil->Precio;
					echo "</td></tr>";
				}
			echo "</table>";
			echo "<br>";
			echo "<input type=\"hidden\" name=\"tipo_formulario\" value=\"guardar\">";
			echo "<input type=\"submit\" name=\"submit\" value=\"GUARDAR\" class=\"boton\">";
			echo "</form>";
		}
	?>

</body>
</html>
