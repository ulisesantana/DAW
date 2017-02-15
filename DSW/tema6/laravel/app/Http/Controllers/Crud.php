<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class Crud extends Controller
{
    // FUNCIÓN PARA CUANDO SE ACCEDE A /agenda POR GET
    public function start(Request $req){
      if ($this->checkSession($req)) {
        $registros = DB::select('SELECT * FROM t_contactos ORDER BY nombre');
        $mensaje = count($registros).' contactos encontrados en la agenda.';
        $data = [
          'mensaje' => $mensaje,
          'resultado' => $registros,
          'nombre' => '',
          'telefono' => ''
        ];

        return view('crud/agenda', $data);
      } else {
        return redirect()->action('Crud@login');
      }
    }

    // FUNCIÓN PARA INICIAR SESIÓN
    public function login(Request $req){
      if($req->user == 'test' && $req->pass == 'test'){
        $req->session()->put('session', true);
        return redirect()->action('Crud@start');
      } else {
        return view('crud/login', ['mensaje' => 'Contraseña o usuario incorrectos']);
      }
    }

    // FUNCIÓN PARA CERRAR SESIÓN
    public function logout(Request $request){
      $request->session()->flush();
      return redirect('agenda/login');
    }

    // FUNCIÓN PARA COMPROBAR SI SE HA INICIADO SESIÓN
    private function checkSession($req){
      if ($req->session()->has('session')) {
        return true;
      } else {
        return false;
      }
    }

    // FUNCIÓN PARA CUANDO SE ACCEDE A /agenda POR POST
    public function app(Request $req){

      if($req->buscar){ //FORMULARIO DE BÚSQUEDA
        $response = $this->buscar($req);
        $mensaje = $response['mensaje'];
        $registros = $response['registros'];
      }

      if($req->add){ //FORMULARIO PARA AÑADIR CONTACTO
        if (!isset($req->name) || !isset($req->tlf)) {
          $mensaje='No has rellenado todos los campos para añadir un contacto.';
        } elseif(!$this->existeContacto($req->name,$req->tlf)) {
          DB::insert('INSERT INTO t_contactos (nombre, telefono)
                        VALUES(?,?)',[$req->name,$req->tlf]);
          $mensaje='Contacto añadido correctamente.';
        } else {
          $mensaje='El contacto existe en la base de datos.';
        }

        $registros = DB::select('SELECT * FROM t_contactos ORDER BY nombre');
      }

      if($req->editar){ // FORMULARIO PARA EDITAR CONTACTO
        DB::update('UPDATE t_contactos SET nombre=?,telefono=?
                      WHERE id=?',[$req->name, $req->tlf, $req->id]);

        $registros = DB::select('SELECT * FROM t_contactos ORDER BY nombre');
        $mensaje='Tu contacto se ha actualizado correctamente. '.
                    count($registros).' contactos encontrados en tu agenda.';
      }

      if($req->borrar){ //BOTÓN PARA BORRAR USUARIO
        DB::delete('DELETE FROM t_contactos WHERE id=?',[$req->id]);
        $registros = DB::select('SELECT * FROM t_contactos ORDER BY nombre');
        $mensaje='Tu contacto se ha borrado correctamente. '.
                    count($registros).' contactos encontrados en tu agenda.';
      }

      $data = [
        'mensaje' => $mensaje,
        'resultado' => $registros,
        'nombre' => (!$req->editar) ? $req->name : '',
        'telefono' => (!$req->editar) ? $req->tlf : ''
      ];

      return view('crud/agenda', $data);
    }

    //FUNCIÓN QUE BUSCA EL CONTACTO
    private function buscar($req){
      if (isset($req->name) && isset($req->tlf)) {
        $registros = DB::select('SELECT * FROM t_contactos
          WHERE nombre LIKE ? AND telefono LIKE ?
          ORDER BY nombre',[$req->name.'%', $req->tlf.'%']);

      } elseif (isset($req->name)) {
        $registros = DB::select('SELECT * FROM t_contactos
          WHERE nombre LIKE ?
          ORDER BY nombre',[$req->name.'%']);

      } elseif (isset($req->tlf)) {
        $registros = DB::select('SELECT * FROM t_contactos
          WHERE telefono LIKE ?
          ORDER BY telefono',[$req->tlf.'%']);

      } else {
        $registros = DB::select('SELECT * FROM t_contactos ORDER BY nombre');
      }

      $mensaje = count($registros).' contactos coinciden con tu búsqueda.';

      $response = [
        'mensaje' => $mensaje,
        'registros' => $registros
      ];

      return $response;
    }

    //FUNCIÓN QUE DETERMINA SI EXISTE O NO UN CONTACTO EN LA db
    private function existeContacto($nombre, $telefono){
      $registros = DB::select('SELECT * FROM t_contactos
        WHERE nombre = ? AND telefono = ?',[$nombre, $telefono]);
      if(count($registros) > 0){
        return true;
      } else {
        return false;
      }
    }
}
