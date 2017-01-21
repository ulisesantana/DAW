<?php
session_start();

function destroy(){
  $_SESSION = array();
  setcookie(session_name(),'',time()-3600,'/');
  session_destroy();
}

function post($method){
  $names = (isset($_SESSION['names'])) ? $_SESSION['names'] : [''];

  // && !in_array($_POST['name'], $names)

  if ($method == "POST"
    && !isset($_POST['destroy'])
    && !in_array($_POST['name'], $names)){
    if (isset($_SESSION['names'])) {
      array_push($_SESSION['names'], $_POST['name']);
    } else {
      $_SESSION['names'] = [$_POST['name']];
    }
  }
  elseif ($method == "POST" && isset($_POST['destroy'])) {
    destroy();
  }
}

function renderNames($name){
  $html = '<ul>';
  if (isset($_SESSION[$name])) {
    $names = $_SESSION[$name];

    foreach ($names as $key => $value) {
      $html .= '<li>'.$value.'</li>';
    }

    $html .= '</ul>';

    return $html;
  } else {
    return '';
  }

}
?>
