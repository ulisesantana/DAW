<?php
	if (isset($_REQUEST['accion'])) {
		$accion = $_REQUEST['accion'];


	} else {
		exit;
	}

	$conexion = new mysqli("localhost", "root", "", "db_inventario");
	if ($conexion->connect_error)
		die("Conexión fallida: ".$conexion->connect_error);

	// EJERCICIO 1:
	if ($accion == "buscar") {
		if (empty($_REQUEST['marcaBuscar'])) {
			mostrarTablaPortatiles(todosLosPortatiles());
		} else {
			mostrarTablaPortatiles(portatilesDeUnaMarca($_REQUEST['marcaBuscar']));
		}


	}


	// EJERCICIO 2:
	if ($accion == "eliminar" && isset($_REQUEST['portatiles'])) {
		eliminarPortatiles(explode(',',$_REQUEST['portatiles']));
		if (empty(trim($_REQUEST['marcaBuscar']))) {
			mostrarTablaPortatiles(todosLosPortatiles());
		} else {
			mostrarTablaPortatiles(portatilesDeUnaMarca($_REQUEST['marcaBuscar']));
		}

	}


	// EJERCICIO 3:
	if ($accion == "insertar" && isset($_REQUEST['marca'])
 				&& isset($_REQUEST['procesador']) && isset($_REQUEST['RAM'])
			  && isset($_REQUEST['disco'])) {
		$marca = $_REQUEST['marca'];
		$procesador = $_REQUEST['procesador'];
		$ram = $_REQUEST['RAM'];
		$disco = $_REQUEST['disco'];

		insertarPortatil($marca, $procesador, $ram, $disco);
	}


	// EJERCICIO 4:
	if ($accion == "descargar" && $_SERVER['REQUEST_METHOD'] == 'GET') {
		if (empty($_REQUEST['marca'])) {
			exportarCSV(todosLosPortatiles());
		} else {
			exportarCSV(portatilesDeUnaMarca($_REQUEST['marcaBuscar']));
		}
	}

	$conexion->close();

	////////////////////////////////////////////////////////////////////////////////////////////////////////////

	function mostrarTablaPortatiles ($portatiles) {
		echo "<span class=\"titulo\" style=\"color:green;\">".count($portatiles).
					" portátiles encontrados"."</span>";
		echo "<br><br>";
		echo "<table class=\"titulo\" style=\"border-collapse:collapse; border:1px solid black; width:525px; text-align:center; background:#F6F6F6;\" border=\"0\" cellpadding=\"2\">";
		echo '<thead>
						<th></th>
						<th>Marca</th>
						<th>Procesador</th>
						<th>RAM(GB)</th>
						<th>DISCO(GB)</th>
					</thead>';
		for ($i=0; $i < count($portatiles); $i++) {
			echo '<tbody>
							<tr>
								<td><input type="checkbox" id="'.$portatiles[$i]['id'].'" value=""></td>
								<td>'.$portatiles[$i]['marca'].'</td>
								<td>'.$portatiles[$i]['procesador'].'</td>
								<td>'.$portatiles[$i]['RAM'].'</td>
								<td>'.$portatiles[$i]['disco'].'</td>
							</tr>
						</tbody>';
			}

		echo "</table>";
	}

	function todosLosPortatiles(){
		global $conexion;
		$portatiles = [];
		$consultaSQL = 'SELECT * FROM `t_portatiles`;';
		$resultado = $conexion->query($consultaSQL); // ejecutamos la consulta
		if ($resultado->num_rows > 0) { // si existe al menos una fila
			while ($row = $resultado->fetch_assoc()) {
				$portatiles[] = $row;
			}
			$resultado->close();
		}
		return $portatiles;
	}

	function portatilesDeUnaMarca($marca){
		global $conexion;
		$portatiles = [];
		$consultaSQL = 'SELECT * FROM `t_portatiles` WHERE marca = "'.$marca.'";';
		$resultado = $conexion->query($consultaSQL); // ejecutamos la consulta
		if ($resultado->num_rows > 0) { // si existe al menos una fila
			while ($row = $resultado->fetch_assoc()) {
				$portatiles[] = $row;
			}
			$resultado->close();
		}
		return $portatiles;
	}

	function eliminarPortatiles($idsPortatiles){
		global $conexion;
		for ($i=0; $i < count($idsPortatiles); $i++) {
			$consultaSQL = 'DELETE FROM `t_portatiles` WHERE id = "'.$idsPortatiles[$i].'";';
			if ($conexion->query($consultaSQL) === FALSE) {
				echo "Error: ".$conexion->error;
			}
		}
	}

	function insertarPortatil($marca, $procesador, $ram, $disco){
		global $conexion;

		$consultaSQL = 'SELECT * FROM `t_portatiles`
											WHERE marca = "'.$marca.'"
											AND procesador = "'.$procesador.'"
											AND RAM = "'.$ram.'"
											AND disco = "'.$disco.'";';
		$find = $conexion->query($consultaSQL);
		if ($find->num_rows > 0) {
			echo "El portátil que quieres insertar ya existe.";
		} else{
			$consultaSQL = 'INSERT INTO `t_portatiles` (`marca`, `procesador`, `RAM`, `disco`)
												VALUES ("'.$marca.'", "'.$procesador.'",
												"'.$ram.'", "'.$disco.'");';
			if ($conexion->query($consultaSQL) === FALSE) {
				echo "Error: ".$conexion->error;
			} else{
				mostrarTablaPortatiles(todosLosPortatiles());
			}

		}
	}

	function exportarCSV($portatiles){
		$file = 'portatiles.csv';

		for ($i=0; $i < count($portatiles); $i++) {
			$csv .= implode(',',$portatiles[$i]);
		}

		$csv .= PHP_EOL;

		$writeFile = fopen($file, 'w');
		fputs($writeFile, $csv);
		fclose($writeFile);

		if (is_file($file)){
			 header('Content-Type: application/force-download');
			 header('Content-Disposition: attachment; filename='.$file);
			 header('Content-Transfer-Encoding: binary');
			 header('Content-Length: '.filesize($file));

			 readfile($file);
		}
		else {
			 header('inventario.html');
		}
	}



?>
