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

	$conexion = new mysqli("localhost", "root", "", "db_notas_varias_asignaturas");
	if ($conexion->connect_error)
		die("Conexión fallida: ".$conexion->connect_error);

	if ($accion == "buscar" && isset($_REQUEST['asignatura'])) {
		$asignatura = $_REQUEST['asignatura'];
		mostrarAlumnos($asignatura);
	}

	if ($accion == "matricular" && isset($_REQUEST['alumno']) &&
			isset($_REQUEST['asignatura'])) {
		$alumno = $_REQUEST['alumno'];
		$asignatura = $_REQUEST['asignatura'];
		matricular($alumno, $asignatura);
	}

	if ($accion == "eliminar" && isset($_REQUEST['asignatura'])) {
		$asignatura = $_REQUEST['asignatura'];
		eliminarAsignatura($asignatura);
	}

	if ($accion == "add" && isset($_REQUEST['asignatura'])) {
		$asignatura = $_REQUEST['asignatura'];
		addAsignatura($asignatura, $profesor);
	}

	$conexion->close();


	////////////////////////////////////////////////////////////////////////////////////////////////////////////

	function matricular($alumno, $asignatura){
		global $conexion;
		$alumnosMatriculados = alumnosDeUnaAsignatura($asignatura);
		$matriculado = (in_array($alumno, $alumnosMatriculados)) ? true : false;

		if (!$matriculado) {
			$consultaSQL = 'INSERT INTO `t_notas`(`alumno`, `asignatura`, `nota`)
			VALUES ("'.$alumno.'","'.$asignatura.'",null);';
			if ($conexion->query($consultaSQL) === FALSE) {
				echo "Error: ".$conexion->error;
			}
		} else {
			$consultaSQL = 'DELETE FROM `t_notas` WHERE alumno = "'.$alumno.'"
												AND asignatura = "'.$asignatura.'";';
			if ($conexion->query($consultaSQL) === FALSE) {
				echo "Error: ".$conexion->error;
			}
		}

	}

	function eliminarAsignatura($asignatura){
		global $conexion;
		$consultaSQL = 'DELETE FROM `t_asignaturas` WHERE asignatura = "'.$asignatura.'";';
		if ($conexion->query($consultaSQL) === FALSE) {
			echo "Error: ".$conexion->error;
		}
	}

	function addAsignatura($asignatura, $profesor){
		global $conexion;


		$consultaSQL = 'SELECT * FROM `t_asignaturas`
											WHERE asignatura = "'.$asignatura.'"
											AND profesor = "'.$profesor.'";';
		$find = $conexion->query($consultaSQL);
		if ($find->num_rows > 0) {
			echo "La asignatura que quieres insertar ya existe.";
		} else{
			$consultaSQL = 'INSERT INTO `t_asignaturas` (`asignatura`, `profesor`)
			VALUES ("'.$asignatura.'", "'.$profesor.'");';
			if ($conexion->query($consultaSQL) === FALSE) {
				echo "Error: ".$conexion->error;
			} 
		}
	}

	function todosLosAlumnos(){
		global $conexion;
		$alumnos = [];
		$consultaSQL = 'SELECT usuario FROM `t_usuarios` WHERE tipo = "Alumno";';
		$resultado = $conexion->query($consultaSQL); // ejecutamos la consulta
		if ($resultado->num_rows > 0) { // si existe al menos una fila
			while ($row = $resultado->fetch_assoc()) {
				$alumnos[] = $row["usuario"];
			}
			$resultado->close();
		}
		return $alumnos;
	}

	function alumnosDeUnaAsignatura($asignatura){
		global $conexion;
		$alumnos = [];
		$consultaSQL = 'SELECT alumno FROM `t_notas` WHERE asignatura = "'.$asignatura.'";';
		$resultado = $conexion->query($consultaSQL); // ejecutamos la consulta
		if ($resultado->num_rows > 0) { // si existe al menos una fila
			while ($row = $resultado->fetch_assoc()) {
				$alumnos[] = $row["alumno"];
			}
			$resultado->close();
		}
		return $alumnos;
	}

	function mostrarAlumnos($asignatura){
		$alumnos = todosLosAlumnos();
		$alumnosMatriculados = alumnosDeUnaAsignatura($asignatura);

		echo "<table class=\"tabla\" border=\"0\" cellpadding=\"6\">";
		echo "<tr>";
				echo "<th>Alumno</th>";
				echo "<th>Matriculado</th>";
		echo "</tr>";
		for ($i = 0; $i < count($alumnos); $i++) {
			$matriculado = (in_array($alumnos[$i], $alumnosMatriculados)) ? 'checked' : '';

			echo "<tr onMouseOver=\"this.style.backgroundColor='#22BBFF';\"
							onMouseOut=\"this.style.backgroundColor='#CCCCCC';\">";
			echo "<td>";
				echo $alumnos[$i];
			echo "</td>";
			echo "<td>";
				echo '<input type="checkbox"
								value="'.$alumnos[$i].'" '.$matriculado.'
								onchange="matricular(this.value)" >';
			echo "</td></tr>";
		}
		echo "</table>";
	}

?>
