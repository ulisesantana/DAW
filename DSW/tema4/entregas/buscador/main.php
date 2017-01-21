<?php
  $marca = $motor = $km = $precio = $ano= "";

	// captura de parámetros de búsqueda:
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		if (isset($_POST['marca'])) $marca = strtoupper($_POST['marca']);
		if (isset($_POST['motor'])) $motor = strtoupper($_POST['motor']);
		if (isset($_POST['ano'])) $ano = $_POST['ano'];
		if (isset($_POST['km'])) $km = $_POST['km'];
		if (isset($_POST['precio'])) $precio = $_POST['precio'];
	}

	libxml_use_internal_errors(true);
	$Coches = simplexml_load_file("coches.xml") or die("No se encuentra el archivo .xml");
	if ($Coches === false)
		echo "Error en el archivo XML";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // buscar coches
    $arrayCoches = buscarCoches($Coches->Coche, $marca, $motor, $km, $precio, $ano);
    echo json_encode($arrayCoches);
  } elseif ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_REQUEST['id'])) {
    $fileName = 'coche'.$_REQUEST['id'].'.xml';
    $coche = getCoche($Coches->Coche, $_REQUEST['id']);

    $xml = '<?xml version = "1.0" encoding = "UTF-8" ?>
      <!DOCTYPE Coches [
       <!ELEMENT Coches (Coche*)>
       <!ELEMENT Coche (ID, Marca, Modelo, Motor, Año, Km, Precio, Descripcion, URLImagen)>
       <!ELEMENT ID (#PCDATA)>
       <!ELEMENT Marca (#PCDATA)>
       <!ELEMENT Modelo (#PCDATA)>
       <!ELEMENT Motor (#PCDATA)>
       <!ELEMENT Año (#PCDATA)>
       <!ELEMENT Km (#PCDATA)>
       <!ELEMENT Precio (#PCDATA)>
       <!ELEMENT Descripcion (#PCDATA)>
       <!ELEMENT URLImagen (#PCDATA)>
    ]>

    <Coches>
      <Coche>
        <ID>'.$coche->ID.'</ID>
        <Marca>'.$coche->Marca.'</Marca>
        <Modelo>'.$coche->Modelo.'</Modelo>
        <Motor>'.$coche->Motor.'</Motor>
        <Año>'.$coche->Año.'</Año>
        <Km>'.$coche->Km.'</Km>
        <Precio>'.$coche->Precio.'</Precio>
        <Descripcion>'.$coche->Descripcion.'</Descripcion>
        <URLImagen>'.$coche->URLImagen.'</URLImagen>
      </Coche>
    </Coches>';

    $writeFile = fopen($fileName, 'w');
    fputs($writeFile, $xml);
    fclose($writeFile);

    echo $fileName;
  } else{
    // mostrar todos los coches
    echo json_encode(cars2Array($Coches));
  }

  function cars2Array($XML, $array = array()){
    foreach ($XML as $value) {
      $array[] = $value;
    }
    return $array;
  }

  function buscarCoches ($arrayCoches, $marca, $motor, $km, $precio, $ano) {
    $arrayCochesEncontrados = array();
    foreach ($arrayCoches as $Coche) {
      if ((strtoupper($Coche->Marca) == $marca || $marca == "TODOS") &&
        (strtoupper($Coche->Motor) == $motor || $motor == "TODOS") &&
        ($Coche->Km <= $km || $km == "TODOS") &&
        ($Coche->Precio <= $precio || $precio == "TODOS") &&
        ($Coche->Año <= $ano || $ano == "TODOS")) {
          array_push($arrayCochesEncontrados, $Coche);
      }
    }
    return $arrayCochesEncontrados;
  }

  function getCoche ($arrayCoches, $marca, $motor, $km, $precio, $ano) {
    $array = array();
    foreach ($arrayCoches as $Coche) {
      if ($Coche->ID == $id) {
          array_push($array, $Coche);
      }
    }
    return $array[0];
  }



?>
