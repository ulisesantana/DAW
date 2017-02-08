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
    - `type`: Devuelve el modo de transferencia que se está usando (`ascii` o `binary`)
    - `passive`: Establece que se pase al modo de conexión de datos pasivo si se está actualmente trabajando en modo activo o, al revés.. En la respuesta del comando se indica si el modo pasivo queda activado o desactivado. En el modo pasivo puede enviar los archivos por varios puertos aparte del 20.
  - Manejo de archivos remotos:
    - `get <F1> <F2>`: Descarga el archivo remoto `F2` y guárdalo en el directorio local de trabajo con el nombre `F1`. El archivo `F2` debe existir en el directorio remoto. Si no se escribe `F1`, el archivo se guarda con el nombre `F2`.
    - `mget`: Descarga al directorio local actual los archivos indicados del directorio remoto. En archivos se pueden usar comodines (* y ?) o escribir varios nombres de archivos separados por espacios. Al ejecutar el comando nos pide confirmación.
    - `put <F1> <F2>`: Sube el archivo local `F1` al directorio remoto y lo guarda con el nombre `F2`.
    - `mput`: Sube al directorio remoto actual los archivos indicados desde el directorio local.
    - `delete`: Elimina el archivo del directorio remoto.
    - `rename <F1> <F2>`: Renombra el archivo `F1` del directorio remoto actual con el nombre `F2`.
  - Manejo de directorios remotos:
    - `ls`: Listar el directorio remoto.
    - `cd <directorio>`: Cambiar el directorio remoto actual de trabajo.
    - `mkdir <directorio>`: Crea en el directorio remoto actual el directorio indicado.
    - `rmdir <directorio>`: Elimina el directorio indicado del directorio remoto actual de trabajo.
    - `pwd`: Muestra la ruta del directorio remoto actual de trabajo.
  - Manejo de directorios locales:
    - `lcd <directorio>`: Cambia de directorio local actual de trabajo. Si no se escribe el directorio, el comando devuelve cual es el directorio local actual de trabajo.
    - `lpwd`: Muestra la ruta del directorio local actual de trabajo.

## Respuestas del servidor
  - **1xy**: La acción solicitada no ha terminado.
  - **2xy**: La acción solicitada se ha realizado con éxito. El cliente puede enviar otro comando/acción.
  - **3xy**: El cliente debe indicar información adicional para completar la acción solicitada.
  - **4xy**: La acción solicitada no se ha podido realizar ahora pero podría realizarse más tarde.
  - **5xy**: La acción solicitada no se puede realizar.

## Archivos de configuración del servidor ProFTPD
  - `/etc/proftpd/proftpd.conf`: configuración del servidor FTP.
  - `/etc/ftpusers`: usuarios que tienen prohibido conectarse al servidor FTP (blacklist)

## Configuración para usuario anónimo
```
<Anonymous ~ftp>
  User                ftp
  Group               nogroup
  UserAlias           anonymous ftp
  DirFakeUser         on ftp
  DirFakeGroup        on ftp
  RequireValidShell   off

  # Limitar el máximo número de logins anónimos concurrentes:
  MaxClients          10

  # Mensaje de conexión:
  DisplayLogin        welcome.msg

  # No permitir ESCRITURA en cualquier directorio:
  <Directory *>
    <Limit WRITE>
      DenyAll
    </Limit>
  </Directory>
</Anonymous>
```

Después de añadir el usuario recarga el servicio: `service proftpd reload`

## Configuración para usuario invitado:

```
<Anonymous ~invitado>
  User      invitado
  Group     nobody

  # Se requiere la contraseña de sistema del usuario invitado
  AnonRequirePassword     on

  # No permitir ESCRITURA en ningún directorio
  <Directory *>
    <Limit WRITE>
      DenyAll
    </Limit>
  </Directory>
</Anonymous>
```

Antes de añadir esto a `/etc/proftpd/proftpd.conf` tienes que haber creado el usuario *invitado* en Linux (`adduser invitado`). Después hay que recargar el servicio: `service proftpd reload`

## Configuración SFTP
  1. Descomentar la siguiente línea del archivo `/etc/proftpd/proftpd.conf`:
    - Include /etc/proftpd/tls.conf

  2. Generar un Certificado Digital de prueba con el comando:
    - `proftpd-gencert`

  3. Editar el archivo `/etc/proftpd/tls.conf`:
    ```
    <IfModule mod_tls.c>
      TLSEngine                   on
      TLSLog                      /var/log/proftpd/tls.log
      TLSProtocol                 SSLv23

      TLSRSACertificateFile       /etc/ssl/certs/proftpd.crt
      TLSRSACertificateKeyFile    /etc/ssl/private/proftpd.key

      TLSVerifyClient             off

      TLSRequired                 on
    <IfModule>
    ```
  4. Recargar el servicio:
    - `service proftpd reload`
