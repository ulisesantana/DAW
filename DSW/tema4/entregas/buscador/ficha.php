<?php
//Si la variable id que pasamos por URL no esta
//establecida acabamos la ejecucion del script.
if (!isset($_GET['id']) || empty($_GET['archvo'])) {
   exit();
}

//Utilizamos basename por seguridad, devuelve el
//nombre del id eliminando cualquier ruta.
$id = basename($_GET['id']);

$ruta = 'coches'.$id;

if (is_file($ruta))
{
   header('Content-Type: application/force-download');
   header('Content-Disposition: attachment; filename='.$id);
   header('Content-Transfer-Encoding: binary');
   header('Content-Length: '.filesize($ruta));

   readfile($ruta);
}
else
   exit();
?>
