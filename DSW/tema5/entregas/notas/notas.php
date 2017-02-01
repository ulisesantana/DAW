<?php
	session_start();

	if (isset($_SESSION['usuario']) && isset($_SESSION['tipo'])) {
		$tipo = $_SESSION['tipo'];
		if ($tipo == "Profesor") {
			$profesor = $_SESSION['usuario'];
		} else {
			header("Location: login.php");
		}
	} else {
		header("Location: login.php");
	}

	if (isset($_REQUEST['accion']))
		$accion = $_REQUEST['accion'];
	else
		exit;

		$alumno = $nota = "";

		$conexion = new mysqli("localhost", "root", "", "db_notas_varias_asignaturas");
		if ($conexion->connect_error)
			die("Conexión fallida: ".$conexion->connect_error);


		if ($accion == "buscar" && isset($_REQUEST['nota']) && isset($_REQUEST['asignatura'])) {
			$nota = $_REQUEST['nota'];
			$asignatura = $_REQUEST['asignatura'];
			$arrayAlumnos = buscarAlumnos($nota, $asignatura);
			mostrarTablaAlumnos($arrayAlumnos, $asignatura);
		}

		if ($accion == "modificar" && isset($_REQUEST['alumno']) &&
				isset($_REQUEST['nota']) && isset($_REQUEST['listar']) &&
				isset($_REQUEST['asignatura'])) {
			$alumno = $_REQUEST['alumno'];
			$nota = $_REQUEST['nota'];
			$asignatura = $_REQUEST['asignatura'];
			$listar = $_REQUEST['listar'];

			modificarNota($alumno, $nota, $asignatura);
			$arrayAlumnos = buscarAlumnos($listar, $asignatura);
			mostrarTablaAlumnos($arrayAlumnos, $asignatura);
		}

		$conexion->close();


	////////////////////////////////////////////////////////////////////////////////////////////////////////////

	function calcularEstadisticas ($asignatura) {
		global $conexion;
		$consultaSQL = "SELECT * FROM t_notas WHERE asignatura = '".$asignatura."';";
		$res = $conexion->query($consultaSQL);
		$totalAlumnos = $res->num_rows;
		$res->close();
		$consultaSQL = "SELECT * FROM t_notas WHERE nota >= 5 AND asignatura = '".$asignatura."';";
		$res = $conexion->query($consultaSQL);
		$aprobados = $res->num_rows;
		$res->close();
		$consultaSQL = "SELECT * FROM t_notas WHERE nota < 5 AND asignatura = '".$asignatura."';";
		$res = $conexion->query($consultaSQL);
		$suspensos = $res->num_rows;
		$res->close();
		$resultado = array();
		$resultado['numeroAprobados'] = $aprobados;
		$resultado['numeroSuspensos'] = $suspensos;
		$resultado['numeroAlumnos'] = $totalAlumnos;
		$resultado['porcentajeAprobados'] = round($aprobados/$totalAlumnos*100)."%";
		$resultado['porcentajeSuspensos'] = round($suspensos/$totalAlumnos*100)."%";
		return $resultado;
	}

	function mostrarTablaAlumnos ($arrayAlumnos, $asignatura) {
		echo "<span class=\"texto\">".count($arrayAlumnos)." alumnos encontrados</span><br>";
		$estadisticas = calcularEstadisticas($asignatura);
		echo "<span class=\"texto\">Estadísticas: ".$estadisticas['numeroAprobados'].
					" alumnos aprobados (".$estadisticas['porcentajeAprobados'].") y ".
					$estadisticas['numeroSuspensos']." suspensos (".$estadisticas['porcentajeSuspensos'].")
					de ".$estadisticas['numeroAlumnos']."</span>";
		echo "<br><br>";
		echo "<table class=\"tabla\" border=\"0\" cellpadding=\"6\">";
		echo "<tr>";
				echo "<th>Alumno</th>";
				echo "<th>Nota</th>";
		echo "</tr>";
		for ($i = 0; $i < count($arrayAlumnos); $i++) {
			$alumno = $arrayAlumnos[$i]["alumno"];
			$nota = $arrayAlumnos[$i]["nota"];
			echo "<tr onMouseOver=\"this.style.backgroundColor='#22BBFF';\"
							onMouseOut=\"this.style.backgroundColor='#CCCCCC';\">";
			echo "<td>";
				echo $alumno;
			echo "</td>";
			echo "<td>";
				echo "<select class=\"tabla\" style=\"width:90px; font-size:16px;\"
								onChange=\"modificarNota('".$alumno."',this.value);\">";
					echo "<option value=\"nulo\">-</option>";
					for ($j=1; $j<=10; $j++) {
						if ($j == $nota)
							$seleccionado = "selected";
						else
							$seleccionado = "";
						echo "<option value=\"".$j."\" ".$seleccionado.">".$j."</option>";
					}
				echo "</select>";
			echo "</td></tr>";
		}
		echo "</table>";
	}

	function buscarAlumnos ($nota, $asignatura) {
		global $conexion;

		$arrayAlumnos = array();

		switch ($nota) {
			case "TODOS":
				$condicion = "WHERE asignatura = '".$asignatura."'";
				break;
			case "aprobados":
				$condicion =  "WHERE nota >= 5 AND asignatura = '".$asignatura."'";
				break;
			case "suspensos":
				$condicion =  "WHERE nota < 5 AND asignatura = '".$asignatura."'";
				break;
		}
		$consultaSQL = "SELECT * FROM t_notas ".$condicion." ORDER BY alumno;"; // consulta
		$resultado = $conexion->query($consultaSQL); // ejecutamos la consulta
		if ($resultado->num_rows > 0) { // si existe al menos una fila
			$i = 0;
			while ($registro = $resultado->fetch_assoc()) {
				$arrayAlumnos[$i]["alumno"] = $registro["alumno"];
				$arrayAlumnos[$i]["nota"] = $registro["nota"];
				$i++;
			}
			$resultado->close();
		}
		return $arrayAlumnos;
	}

	function modificarNota ($alumno, $nota, $asignatura) {
		global $conexion;
		$consultaSQL = "UPDATE t_notas SET nota='".$nota."' WHERE alumno='".$alumno."' AND asignatura = '".$asignatura."';";
		if ($conexion->query($consultaSQL) === FALSE) {
			echo "Error: ".$conexion->error;
		}
	}

?>
