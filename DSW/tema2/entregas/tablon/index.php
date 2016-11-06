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
                    font-size:'.$noticia->TamanoTexto.';"
                  >
                    '.$noticia->Texto.'
                </p>
              </div>';
          }
        }

       ?>
    </div>
</body>

</html>
