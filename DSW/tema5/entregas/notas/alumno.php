<?php

	session_start(); // continua con la sesion

	if (isset($_SESSION['usuario'])) {

		$usuario = $_SESSION['usuario'];

		if (isset($_SESSION['tipo'])) {

			$tipo = $_SESSION['tipo'];
			if ($tipo == "Alumno") {
				$horaInicio = $_SESSION['horainicio'];
			} else { // si no existe la sision te redirijo a al login
				header("Location: login.php");
			}
		} else {
			header("Location: login.php");
		}
	} else {
		header("Location: login.php");
	}

	function obtenerNota ($alumno) {

		global $conexion;

		$consultaSQL = "SELECT * FROM t_notas WHERE alumno = '".$alumno."';";
		$resultado = $conexion->query($consultaSQL);
		$registro = [];
		if ($resultado->num_rows > 0) {
			while ($row = mysqli_fetch_assoc($resultado)) {
        $registro[] = $row;
    	}
			$resultado->close();
			return $registro;
		} else
			return false;
	}

	function calcularEstadisticas ($asignatura) {

		global $conexion;
		$consultaSQL = "SELECT * FROM t_notas WHERE asignatura = '".$asignatura."';";
		$res = $conexion->query($consultaSQL);
		$totalAlumnos = $res->num_rows;
		$res->close();
		$consultaSQL = "SELECT * FROM t_notas WHERE nota >= 5 AND asignatura = '".$asignatura."';"; // aprobados
		$res = $conexion->query($consultaSQL);
		$aprobados = $res->num_rows;
		$res->close();
		$consultaSQL = "SELECT * FROM t_notas WHERE nota < 5 AND asignatura = '".$asignatura."';"; // suspendidos
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
?>

<html>
<head>
	<title>Notas - Alumno</title>
	<link rel="stylesheet" href="estilos.css">
</head>
<body bgcolor="#11AAEE">
	<br>
	<table>
		<tr>
			<td><img src="imagenes/logo.png" width="128" height="128"></td>
			<td>
				<p class="principal">Has iniciado sesión como:</p>
				<table cellpadding="5">
					<tr><td class="titulo">Usuario:</td> <td class="texto"><?php echo $usuario; ?></td></tr>
					<tr><td class="titulo">Tipo:</td> <td class="texto"><?php echo $tipo; ?></td></tr>
					<tr><td class="titulo">Hora inicio sesión:</td> <td class="texto"><?php echo $horaInicio; ?></td></tr>
				</table>
			</td>
		</tr>
	</table>

	<br>
	<hr align="left" width="560">
	<br>

	<div style="position:absolute; left:10px; top:220px; width:560px; height:auto; border:2px solid gray; background:#CCCCCC;">
		<?php
			$conexion = new mysqli("localhost", "dsw", "dsw", "db_notas_varias_asignaturas");
			if ($conexion->connect_error)
				die("Conexión fallida: ".$conexion->connect_error);

			$notas = obtenerNota($usuario);
	  ?>
			<ul>
			<h2>Asignaturas:</h2>
		<?php
			foreach ($notas as $nota) {
				echo '<li>';
				if ($nota['nota'] == false) {
					$nota = "No tienes nota aún";
					echo "<p class=\"resaltado\" style=\"text-align:center;\">".$nota."</p>";
				} else {
					if ($nota['nota'] < 5) {
						$calificacion = "Tu nota es un ".$nota['nota'];
						echo "<span class=\"resaltado\" >".$nota['asignatura'].": </span><span style=\"color:red; text-align:center;\">".$calificacion."</span>";
					} else {
						$calificacion = "Tu nota es ".$nota['nota'];
						echo "<span class=\"resaltado\" >".$nota['asignatura'].": </span><span class=\"resaltado\" style=\"color:green; text-align:center;\">".$calificacion."</span>";
					}
				}
				$estadisticas = calcularEstadisticas($nota['asignatura']);
				echo "<br>
							<p class=\"texto\" style=\"text-align:center;\">
								Estadísticas: ".$estadisticas['numeroAprobados']." alumnos aprobados (".$estadisticas['porcentajeAprobados'].") y ".
								$estadisticas['numeroSuspensos']." suspensos (".$estadisticas['porcentajeSuspensos'].")
								de ".$estadisticas['numeroAlumnos']." alumnos
							</p>";
				echo '</li>';
			}
			$conexion->close();
		?>
	</ul>
	</div>

	<div name="menu" style="position:absolute; left:410px; top:15px; width:150px; height:65px; background:#DDDDDD;
		border:2px solid gray; padding:5px; text-align:center; font-family:verdana; color:blue; font-size:14px;">
		<span class="titulo"> <?php echo $usuario; ?> </span>
		<hr>
		<button type="button" class="boton" onClick="window.location.assign('logout.php');" onMouseEnter="this.style.backgroundColor='#BBBBBB';" onMouseOut="this.style.backgroundColor='#22BBFF';">CERRAR SESIÓN</button>
	</div>

</body>
</html>
