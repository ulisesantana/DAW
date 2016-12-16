## LAMP
```
    apt-get install -y apache2
    apt-get install -y php5 libapache2-mod-php5 php5-mcrypt
    apt-get install -y mysql-server libapache2-mod-auth-mysql php5-mysql
    apt-get install -y phpmyadmin

```
En caso de que la líes parda y dejaras la contraseña del root de MySQL en blanco puede volver a setearla con el comando `dpkg-reconfigure mysql-server-5.5`

Una vez instalado comprobar en la configuración que está añadido el index.php

### Apache

#### Otros comandos útiles para Apache

*   **Directorio de configuración**: `/etc/apache2`
*   **Directorio de logs**: `/var/log/apache2`
*   **Configuración general**: `/etc/apache2/apache2.conf`
*   **Configuración de los puertos de eschucha**: `/etc/apache2/ports.conf`

_Para que los cambios que hagamos en la configuración surtan efecto deberemos hacer un `service apache2 reload` o `service apache2 restart`_

#### Comandos básicos de Apache

*   `service apache2 start`
*   `service apache2 stop`
*   `service apache2 reload`
*   `service apache2 restart`
*   `service apache2 status`
*   `a2ensite sitio`
*   `a2dissite sitio`
*   `a2enmod modulo`
*   `a2dismod modulo`
*   `a2enconf configuracion`
*   `a2disconf configuracion`

### PHP

*   **Buscar un módulo:** `apt-cache search php5-`
*   **Instalar un módulo:** `apt-get install nombre-modulo`
*   **Borrar binarios un módulo:** `apt-get remove nombre-modulo`
*   **Borrar configuración de un módulo:** `apt-get purge nombre-modulo`

### MYSQL

*   **Cambiar clave de root**: `mysqladmin --user=root password "nuevacontraseña"`
*   **Saber si MySQL está corriento**: `netstat -tunap | grep 3306`
*   **Crear base de datos para la estructura de tablas del sistema:** `mysql_install_db`

#### Comandos básicos de MySQL

*   `service mysql start`
*   `service mysql stop`
*   `service mysql restart`

## Python

### Instalar python

`apt-get install -y python3`

### Poner por defecto python3
```
    rm /usr/bin/python
    ln -s /usr/bin/python3

```
### Instalar pip y el driver de MySQL para python
```
    apt-get update
    apt-get install -y python3-pip
    pip3 install -y pymysql

```
### Configurar Apache2 para python
```
    apt-get install -y apache2-mpm-prefork
    a2dismod mpm_event
    a2enmod mpm_prefork cgi

```
Añadir `index.py` en `/etc/apache2/mods-enabled/dir.conf`

Añade tal cual esta sección <Directory> tras la etiqueta antes de la directiva DocumentRoot en el archivo `/etc/apache2/sites-enabled/000-default.conf`:
```
    <Directory /var/www>
      Options +ExecCGI
      DirectoryIndex index.py
    </Directory>
    AddHandler cgi-script .py

```
## Perl

*   **Instalar perl:** `apt-get install perl libapache2-mod-perl2`
*   **Añadir AddHandler en `/etc/apache2/sites-enabled/000-default.conf`** => AddHandler cgi-script .pl

Si te peta al ejecutar algo en perl ejecuta `tail /var/log/apache2/error.log` para ver que está pasando.

## Linux

*   **Desactivar ventana de avisos de error:** editar `/etc/default/apport` y poner `enabled=0`
*   **Listar procesos y consumo de RAM:** `top`
*   **Listar servidores en ejecución:** `netstat -tunap`
*   **Comprobar uso del disco duro:** `df`

### Habilitar el usuario root

1.  Entrar en modo superusuario (`sudo su`)
2.  Asignar contraseña (`passwd root`)
3.  Abrimos el archivo `/etc/lightdm/lightdm.conf` y le añadimos la siguiente línea:

    `greeter-show-manual-login=true`

5.  Reiniciar el equipo y cambiar la última línea de `/root/.profile` por `tty -s && mesg n`

## Joomla!

*   **Artículos:** Contenido que se publica. Va desde un artículo hasta una página entera.
*   **Extensiones:** todo aquello que se añade para modificar Joomla!:
    *   **Plantillas:** cambio de aspecto, pero no de funcionalidad. Una plantilla de toda la vida.
    *   **Plugins:** funcionalidad simple que sólo modifica dentro del artículo (botón de leer más, por ejemplo).
    *   **Módulos:** funcionalidad sencilla que por lo general se añaden al sidebar (contador de visitas, tag cloud, archivo del blog, etc )
    *   **Componentes:** funcionalidad compleja que se ejecutará dentro del sitio. En sí mismo puede ser un artículo como una tienda online por ejemplo.
    *   **Idiomas:** paquetes para cambiar el lenguaje del sitio.

### Instalar Joomla!

1.  Crear en MySQL la BBDD y el usuario necesarios para la instalación de Joomla! en el servidor web.
2.  Crear subdirectorio en /var/www
3.  Descargar el .zip de Joomla! y llevarlo hasta el directorio.
4.  Descomprimir el .zip: `unzip Joomla.zip`
5.  Cambiar el propietario y los permisos de la carpeta del sitio para que pueda ser ejecutado y escrito por el usuario del sistema encargado de manejar los archivos del sitio: `chown -R www-data:www-data /var/www/joomla chmod -R 755 /var/www/joomla`
6.  Lanzar el instalador visitando `http://localhost/joomla/index.php` y seguir los pasos.
7.  Finalmente borra la carpeta de instalación: `rm -Rf /var/www/joomla/installation`

### Otras cosas sobre Joomla!

*   **Previsualizar los módulos**: Primero tienes que ir a la opciones de plantillas y habilitar _Previsualizar la posición de los módulos_, después sólo tienes que visitar la página que quieres mirar añadiendo `?tp=1` al final.

## Webalizer

*   **Instalar webalizer:** `apt-get webalizer`
*   **Configuración básica de webalizer**: Entrar en `/etc/webalizer/webalizer.conf` y establecer esta configuración: `LogFile /var/log/apache2/access.log OutputDir /var/www/webalizer Incremental yes ReportTitle Estidísticas del servidor web de PDL Hostname Servidor web DPL IgnoreSite localhost`
*   **Generar informe**:
    *   `webalizer`
    *   `webalizer -d` => nos muestra los errores generados al crear el informe.
*   **Ver el informe**: visitar `http://localhost/webalizer` (porque es el OutputDir que hemos configurado)

### Crear informe periódico con Webalizer y Cron

1.  Crear un script dentro del OutputDir que nos haga el informe y nos lo muestre en firefox (por ejemplo):

        ```
        #!/bin/bash

        webalizer
        firefox file://informesweb/index.html
        ```

2.  Editar el cron para añadir la tarea: `crontab -e`

3.  Añadir a la última línea: `* * * * * export DISPLAY=:0 && informesweb/script.sh`

Tal como se ha escrito el cron saltará cada minuto. Para poder configurarlo como quieras puedes fijarte de esta referencia:

    De izquierda a derecha, los asteriscos representan:
    1\. Minutos: de 0 a 59.
    2\. Horas: de 0 a 23.
    3\. Día del mes: de 1 a 31.
    4\. Mes: de 1 a 12.
    5\. Día de la semana: de 0 a 6, siendo 0 el domingo.

Puedes usar intervalos o concatenar con comas:

`0 0,12 * * 1-5 tar -zcf /var/backups/home.tgz /home/`

El anterior código haría una copia de seguridad de lunes a viernes a las 12 de la noche y a las 12 del mediodía.
