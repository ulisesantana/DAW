<?php
$cookie_name = 'contador';
$cookie_expiration_date = time()+(86400 * 365); //En segundos (86400s = 1 día)

if (!isset($_COOKIE[$cookie_name])) {
  $visits = 0;
  setcookie($cookie_name, $visits, $cookie_expiration_date);
} else {
  $visits = $_COOKIE['contador'];
  $visits++;
  setcookie($cookie_name, $visits, $cookie_expiration_date);
}
 ?>
<!DOCTYPE html>
<html>

<head>
    <title> Noticias </title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div id="tablon">
      <?php
        libxml_use_internal_errors(true); //Verifica que es un archivo XML, pero no lo valida

        $xml = simplexml_load_file('Noticias.xml'); //Cargamos el fichero XML
        if ($xml === false) {
          echo 'Error en el archivo XML';
        } else {
          foreach ($xml->Noticia as $noticia) {
            echo '
              <div class="post-it"
                style="
                  left:'.$noticia->X.';
                  top:'.$noticia->Y.';
                  width:'.$noticia->Ancho.';
                  height:'.$noticia->Alto.';
                  background-color:'.$noticia->ColorNoticia.'"
                >
                <p class="noticia"
                  style="
                    color:'.$noticia->ColorTexto.';
                    font-size:'.$noticia->TamanoTexto.';
                    font-family:'.$noticia->TipoLetra.'"
                  >
                    '.$noticia->Texto.'
                </p>
              </div>';
          }
        }
       ?>
    </div>
    <div id="contador" class="text-center">
      <?php
      if ($visits == 1) {
        echo 'Has estado aquí <strong>'.$visits.'</strong> vez';
      } else {
        echo 'Has estado aquí <strong>'.$visits.'</strong> veces';
      }
       ?>
    </div>
</body>

</html>
