<?php
//Para limpiar las strings de los archivos
function clean (&$data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



//Gestión del Login
function login($auth){
  $file = fopen('usuarios.dat', 'r');

  while(!feof($file)) {
    if(clean(fgets($file)) == clean($auth)) {
      fclose($file);
      return true;
    }
  }

  fclose($file);
  return false;
}


//Añade la cookie para el control de usuarios
function setLogin($auth){
  $cookie_name = 'login';
  $cookie_value = $auth;
  $cookie_expiration_date = time()+600; //10 Minutos
  setcookie($cookie_name, $cookie_value, $cookie_expiration_date);
}



//Checker de las respuestas del formulario
function checkValues($noticia){
  foreach ($noticia as $key => $value) {
    if (is_null($noticia[$key])) {
      return false;
    }
  }
  return true;
}



//Actualizar el xml
function updateXML($noticia){
  $readFile = fopen('../Noticias.xml', 'r');

  for ($i=0; !feof($readFile); $i++) {
    $xml[$i]=fgets($readFile);
  }
  fclose($readFile);
  array_pop($xml);
  array_pop($xml);

  //Añadimos la nueva noticia
  $xml[] = '
    <Noticia>
      <X>'.$noticia["x"].'px</X>
      <Y>'.$noticia["y"].'px</Y>
      <Ancho>'.$noticia["ancho"].'px</Ancho>
      <Alto>'.$noticia["alto"].'px</Alto>
      <ColorTexto>'.$noticia["color-text"].'</ColorTexto>
      <ColorNoticia>'.$noticia["color-news"].'</ColorNoticia>
      <TamanoTexto>'.$noticia["text-size"].'%</TamanoTexto>
      <Texto>'.$noticia["text"].'</Texto>
      <TipoLetra>'.$noticia["typo"].'</TipoLetra>
    </Noticia>
  </Noticias>
  ';

  $writeFile = fopen('../Noticias.xml', 'w');
  for ($i=0; $i < count($xml); $i++) {
    fputs($writeFile, $xml[$i]);
  }
  fclose($writeFile);
}



//Añadir usuarios
function addUsers($auth){
  $readFile = fopen('usuarios.dat', 'r');

  for ($i=0; !feof($readFile); $i++) {
    $users[$i]=fgets($readFile);
  }
  fclose($readFile);
  array_pop($users);

  $users[] = $auth;

  $writeFile = fopen('usuarios.dat', 'w');
  for ($i=0; $i < count($users); $i++) {
    fputs($writeFile, $users[$i]);
  }
  fclose($writeFile);

  return '<div id="error" class="alert alert-success">
            Usuario añadido.
          </div>';
}

//Comprueba si el usuario a añadir existe
function userChecker($user){
  $file = fopen('usuarios.dat', 'r');

  while(!feof($file)) {
    $aux = clean(fgets($file));
    $aux = explode('#',$aux);

    if($aux[0] == $user) {
      fclose($file);
      return false;
    }
  }
  fclose($file);
  return true;
}
 ?>
