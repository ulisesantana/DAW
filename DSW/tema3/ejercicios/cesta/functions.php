<?php
session_start();

// Si quieres una función que te devuelva directamente el total del carro
// podríamos usar esta, pero sale más rentable
// añadir $total += $cesta[$i] * $producto->Precio; en la función de renderCart()
//
// function calcCart(){
//   libxml_use_internal_errors(true);
//   $productos = simplexml_load_file("productos.xml");
//   $total = 0;
//   $i=0;
//   $cesta = (isset($_SESSION['cesta'])) ? $_SESSION['cesta'] : [0,0,0];
//
//   foreach ($productos->Producto as $producto) {
//     $total += $cesta[$i] * $producto->Precio;
//     $i++;
//   }
//
//   return $total;
// }

function destroy(){
  $_SESSION = array();
  setcookie(session_name(),'',time()-3600,'/');
  session_destroy();
}

function post($method){
  $cesta = (isset($_SESSION['cesta'])) ? $_SESSION['cesta'] : [0,0,0];
  if ($method == "POST" && !isset($_POST['destroy'])){
    $operacion = $_POST['boton'];
    $producto = $_POST['producto'];

    if ($operacion == "+"){
      $cesta[$producto]++;
    } else {
    if ($cesta[$producto] != 0) $cesta[$producto]--;
    }

    $_SESSION['cesta'] = $cesta; // y guarda el nuevo valor en la variable de sesión
  }
  elseif ($method == "POST" && $_POST['destroy']) {
    destroy();
  }
}


function renderCart(){
  libxml_use_internal_errors(true);
  $productos = simplexml_load_file("productos.xml");
  $form = '';
  $total = 0;
  $i=0; 
  $cesta = (isset($_SESSION['cesta'])) ? $_SESSION['cesta'] : [0,0,0];
  foreach ($productos->Producto as $producto) {
    $form .= '
      <tr>
        <td><img class="center-block" style="max-width:100px;"
          src="'.$producto->Imagen.'" alt="'.$producto->Nombre.'"></td>
        <td>'.$producto->Nombre.'</td>
        <td>'.$producto->Precio.' €</td>
        <td>'.$cesta[$i].'</td>
        <td>
          <form method="post" action="">
            <input type="submit" name="boton" value="+">
            <input type="submit" name="boton" value="-">
            <input type="hidden" name="producto" value="'.$i.'">
          </form>
        </td>
      </tr>';
      $total += $cesta[$i] * $producto->Precio;
      $i++;
  }
  $form .= '
    <tr>
      <td></td>
      <td><strong><span class="pull-right">Total: </span></strong></td>
      <td>'.$total.' €</td>'.// calcCart()
      '<td></td>
      <td>
        <form method="post" action="">
          <input type="submit" value="Vaciar cesta">
          <input type="hidden" name="destroy" value="true">
        </form>
      </td>
    </tr>';
  return $form;
}

?>
