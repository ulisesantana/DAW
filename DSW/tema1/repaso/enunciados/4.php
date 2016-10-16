<?php
  echo '
  <h2>4. Diccionario de Inglés</h2>
<p>
  Diseña una aplicación web llamada
  traductor.php que muestre al usuario dos formularios que le permitan usar un diccionario de Inglés a Español online:
  <ul>
    <li>

  <p>
    Uno de los formularios ejecutará el script añadir.php; que servirá para agregar un par de palabras Inglés-Español al diccionario:
  </p>

  <img class="img-thumbnail center-block" src="./img/enunciado4-1.png" alt="" />
  <p>
  El diccionario se almacenará en un archivo del servidor llamado diccionario.dat y cuya estructura es la siguiente:
  <code>red#rojo blue#azul green#verde house#casa car#coche</code>
  </p>
  <p>
  Antes de añadir una palabra inglesa al diccionario se deberá comprobar que ésta
  no exista ya en el diccionario (aunque esté con minúsculas o mayúsculas).
  </p>
</p>
</li>
<li>
  <p>
  El otro formulario ejecutará el script consultar.php; que buscará la palabra inglesa en el diccionario y mostrará su traducción al español. La búsqueda no deberá tener
  en cuenta las mayúsculas y minúsculas para encontrar la palabra:
  </p>
  <img class="img-thumbnail center-block" src="./img/enunciado4-2.png" alt="" />
  <p>

  Si no existiese tal palabra en el diccionario; la aplicación deberá generar un enlace al traductor de Google para que el usuario pueda traducir su palabra. La URL a emplear para
  usar este traductor es la siguiente: <code>https://translate.google.com/#en/es/palabra-inglesa</code>
  </p>
</li>
</ul>
</p>
  ';
 ?>
