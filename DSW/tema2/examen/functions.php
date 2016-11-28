<?php
//Centrar
function center($path){
  $text = [];
  $chars_in_a_line = 0;

  //abrimos el archivo en modo lectura
  $file = fopen($path, 'r');
  //abrimos el fichero que se va a justificar
  $file_center = fopen($path.'_centrado.txt', 'w+');

  //Desglosamos línea a línea en un array de String
  for ($i=0; !feof($file); $i++) {
    $text[$i]=fgets($file);
  }

  //Comprobamos cuál es la línea más larga
  for ($i=0; $i < count($text); $i++) {
    if(strlen($text[$i])>$chars_in_a_line) $chars_in_a_line = strlen($text[$i]);
  }

  //Recorremos el array con la información del otro fichero
  //le añadimos los espacios y lo escribimos en el fichero justificado
  for ($i=0; $i < count($text); $i++) {
    $length = strlen($text[$i]);
    $text[$i] = giveMeSpaces($chars_in_a_line - $length).$text[$i].giveMeSpaces($chars_in_a_line - $length);
    fputs($file_center, ($text[$i].PHP_EOL));
  }

}

function giveMeSpaces($num_of_spaces){
  $spaces='';
  for ($i=0; $i < $num_of_spaces/2; $i++) {
    $spaces .= ' ';
  }
  return $spaces;
}

//Subir archivos
// $upload = $_FILES['fichero'];
function upload($upload){
  $fileName = $upload['name'];
  $fileSize = $upload['size'];

  if ($fileSize < 32000 && $fileSize > 0) {
    if (!move_uploaded_file($upload['tmp_name'], $fileName)) {
      return '¡Posible ataque de subida de ficheros!\n';
    } else{
      return 'Fichero subido correctamente.';
    }
  } else {
    echo 'Tamaño de archivo incorrecto';
  }
}

?>
