# TEMA 4: Servidor FTP

## Curiosidades generales

  - Es uno de los primeros servicios de internet (1971 en el MIT).
  - Opera por los puertos 20 y 21. El puerto 21 es el puerto de control y el 20 el de datos. Nos conectamos al FTP por el puerto 21 y descargamos y subimos por el 20.
  - Usa el protocolo de transporte **TCP**: fiable y orientado a conexión.
  - Requiere la autentificación de los usuarios para acceder al server (lo que viene siendo loguearse).
  - Los datos no se transmiten cifrados, aunque existe una versión cifrada (SFTP).
  - Transfiere archivos bidireccionalmente entre cliente y servidor:
        - **Subida:** copiar archivos del cliente al servidor.
        - **Bajada:** copiar archivos del servidor al cliente.

## Comandos básicos de FTP:

  - Control de acceso:
    - `open`: abrir un acceso FTP
    - `close`: cierra la sesión con el usuario
    - `user`: permite iniciar sesión cuando ya está establecida una conexión con un servidor.
    - `bye`: desconectar del servidor FTP
    - `exit`: desconectar del servidor FTP
  - Parámetros de transferencia:
    - `type`: Se pasa al modo de transferencia indicado (`ascii` o `binary`)
    - `passive`: Establece que se pase al modo de conexión de datos pasivo si se está actualmente trabajando en modo activo o, al revés.. En la respuesta del comando se indica si el modo pasivo queda activado o desactivado. En el modo pasivo puede enviar los por varios puertos aparte del 20.
  - Manejo de archivos remotos:
    - `get <F1> <F2>`: Descarga el archivo remoto `F2` y guárdalo en el directorio local de trabajo con el nombre `F1`. El archivo `F2` debe existir en el directorio remoto. Si no se escribe `F1`, el archivo se guarda con el nombre `F2`.
    - `mget`:
    - `put`:
    - `mput`:
    - `delete`:
    - `rename`:
  - Manejo de directorios remotos:
    - `ls`: Listar el directorio remoto.
    - `cd`: Cambiar el directorio remoto actual de trabajo.
    - `mkdir`:
    - `rmdir`:
    - `pwd`:
  - Manejo de directorios locales:
    - `lcd`:
    - `lpwd`:
