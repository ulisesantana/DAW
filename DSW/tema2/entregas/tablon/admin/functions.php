<?php
//Para limpiar las strings de los archivos
function cleanValue (&$data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

function show($id){
  echo '<script>
          $("#'.$id.'").show();
        </script>';
}

function hide($id){
  echo '<script>
          $("#'.$id.'").hide();
        </script>';
}

//Gestión del Login
function login($auth){
  $file = fopen('usuarios.dat', 'r');
  $login = false;

  for ($i=0; !feof($file); $i++) {
    if(cleanValue(fgets($file)) == cleanValue($auth)) {
      $login = true;
      hide('login');
      newsForm();
      show('news');
      break;
    }
  }

  if(!$login) {
    echo 'Sesión fallida.';
  }
  //cerramos el fichero
  fclose($file);
}

function checkLogin(){

}

//Escribir el xml
function newNews(){

}

//Renderizar formulario para añadir noticias
function newsForm(){
  echo '
  <script>
    document.getElementById("news").innerHTML = `
    <h3 class="text-center">Añadir una noticia</h3>
    <div class="row">
      <div class="col-md-4">
        <label>Eje X: </label>
      </div>
      <div class="col-md-8">
        <input required type="text" name="x">
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <label>Eje Y: </label>
      </div>
      <div class="col-md-8">
        <input required type="text" name="y"><br>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <label>Ancho: </label>
      </div>
      <div class="col-md-8">
        <input required type="text" name="ancho"><br>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <label>Alto: </label>
      </div>
      <div class="col-md-8">
        <input required type="text" name="alto"><br>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <label>Color del texto: </label>
      </div>
      <div class="col-md-8">
        <input required type="color" name="color-text"><br>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <label>Tamaño del texto: </label>
      </div>
      <div class="col-md-8">
        <input required type="text" name="text-size"><br>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <label>Texto de noticia: </label>
      </div>
      <div class="col-md-8">
        <input required type="text" name="text"><br>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <label>Tipografía: </label>
      </div>
      <div class="col-md-8">
        <select required name="typo">
          <option class="serif" value="">Times New Roman</option>
          <option class="arial" value="">Arial</option>
        </select>
      </div>
    </div>
  <input class="btn btn-success center-block" type="submit" value="Acceder">`;
  </script>
  ';
}
 ?>
