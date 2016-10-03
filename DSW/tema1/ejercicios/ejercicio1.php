<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Ejercicio 1 - Tema 1 - DSW</title>
</head>
<body>
  <h2>Palíndromos</h2>
  <?php
  $text = "oso";
  if ($text == strrev($text)) {
    echo "Es un palíndromo todo loco. O capicúa, como te salga";
  }
  else {
    echo "No coincide un carajo.";
  }
  ?>

  <h2>Añadamos cosas</h2>
  <?php
  $text = "HOLA MUNDO";
  $text2 = "a todo el ";
  $position = 5;

  if ($position > 0) {
    $text = substr($text,0,$position).$text2.substr($text,$position);
    echo $text;
  }
  else {
    echo "No podemos hacer esto con números negativos.";
  }
  ?>

  <?php
  $test = [];

  //Inicializamos un array
  for ($i=0; $i < 5; $i++) {
    $test[$i] = $i;
  }

  //Comprobamos si se carga el array más allá de su valor
  for ($i=0; $i < 6; $i++) {
    array_shift($test);
  }

  $total = count($test);
  echo '<br>'.$total; // Al final nos muestra 0
  ?>

</body>
</html>
