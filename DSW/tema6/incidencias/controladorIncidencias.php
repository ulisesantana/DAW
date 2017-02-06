<?php

namespace larawebapp\Http\Controllers;

use Illuminate\Http\Request;

class controladorIncidencias extends Controller
{
    // Los métodos del controlador se diseñan pensandos  
	// para realizar las operaciones que permite la interfaz
	// de la aplicación:
	
	
	public function insertarIncidencia (Request $request){
		// validación de los datos recibidos:
		if (empty($request->asunto)) {
			return view('formularioRegistrarIncidencia', ['mensaje' => "Debe rellenar los campos obligatorios de la incidencia"]);
		} else {
			// Escribe la incidencia en una sola línea con los valores separados por ":"
			$incidencia = $request->asunto.":".$request->urgente.":".$request->tipo.":".$request->fecha.":";
			$incidencia .= $request->identificador.":".$request->email.":".$request->descripcion;
				
			if (!file_exists("incidencias.dat")){ // Crear el fichero con (w) porque no existe
				$ficheroIncidencias = fopen("incidencias.dat","w");
				fputs($ficheroIncidencias, $incidencia.PHP_EOL);
				fclose($ficheroIncidencias);
			} else {
				$ficheroIncidencias = fopen("incidencias.dat","a"); // Abrir en modo escritura para añadir al final
				fputs($ficheroIncidencias, $incidencia.PHP_EOL);
				fclose($ficheroIncidencias);
			}		
			
			return view('formularioRegistrarIncidencia', ['mensaje' => "Incidencia insertada correctamente"]);
		}
	}
	
	public function listarIncidencias () {
		if (!file_exists("incidencias.dat")){ 
			return view('formularioRegistrarIncidencia', ['mensaje' => "No existen incidencias registradas"]);				
		} else {
			// Cargamos el Modelo:
			$arrayIncidencias = array();
			$ficheroIncidencias = fopen("incidencias.dat","r");
			while (!feof($ficheroIncidencias)) {
				$incidencia = fgets($ficheroIncidencias);
				if (strlen($incidencia) > 0)
					array_push($arrayIncidencias, $incidencia);
			}
			fclose($ficheroIncidencias);
			
			// Le pasamos el Modelo a la Vista:
			return view('listadoIncidencias', ['incidencias' => $arrayIncidencias]);
		}
	}
	
	public function buscarIncidencias (Request $request){
		// validación de los datos recibidos:
		if (empty($request->asunto)) {
			return view('formularioRegistrarIncidencia', ['mensaje' => "Debe indicar el asunto por el que buscar"]);
		} else {
			if (!file_exists("incidencias.dat")){ 
				return view('formularioRegistrarIncidencia', ['mensaje' => "No existen incidencias registradas"]);				
			} else {
				// Cargamos el Modelo:
				$arrayIncidencias = array();
				$ficheroIncidencias = fopen("incidencias.dat","r");
				while (!feof($ficheroIncidencias)) {
					$incidencia = fgets($ficheroIncidencias);
					if (strlen($incidencia) > 0) {
						$arrayIncidencia = explode(":", $incidencia);
						$asunto = $arrayIncidencia[0];
						$pos = stripos($asunto, $request->asunto);
						if ($pos !== false) 
							array_push($arrayIncidencias, $incidencia);
					}
						
				}
				fclose($ficheroIncidencias);
				
				// Le pasamos el Modelo a la Vista:
				return view('listadoIncidencias', ['incidencias' => $arrayIncidencias]);
			}
		}		
	}
	
	public function eliminarIncidencia (Request $request){
		echo "ELIMINAR INCIDENCIA";
	}
}
