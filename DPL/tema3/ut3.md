# TEMA 3: CONFIGURACIÓN AVANZADA DE APACHE

## OpenSSL

 Saber si tienes el módulo de de ssl:
 ```bash
ls /etc/apache2/mods-available
 ```

 Deberías ver **ssl-conf** y **ssl.load** en el listado.

 Habilitar el módulo y reiniciar el servidor apache:
 ```bash
 a2enmod ssl && service apache2 restart
 ```

Modifica el DocumentRoot para que tire del directorio que quieres. Después habilítalo y recarga la configuración:

```bash
a2ensite default-ssl && service apache2 reload
```

Instalar **OpenSSL**
```bash
#Instalar OpenSSL
apt-get install aptitude
aptitude install openssl

#Crear Certificado
mkdir /certificados
openssl genrsa -des -out /certificados/clave.key -out /certificados/certificado.csr

# Genera el certificado en formato x509 y con una validez de un año.
openssl x509 –req –days 365 –in /certificados/certificado.csr –signkey /certificados/clave.key –out /certificados/certificado.crt

# Lo convierte a formato RSA
openssl rsa -in /certificados/clave.key -out /certificados/clave.key
```

Finalmente debemos editar el archivo default-ssl.conf para que use el certificado de prueba creado y luego:

``` bash
service apache2 restart
```

## Prevenir ataques DoS & DDoS
Instalar el módulo necesario:
```bash
apt-get install -y apache2-utils apache2-dev libapache2-mod-evasive
```

Modificar el archivo `/etc/apache2/mods-enabled/evasive.conf` para dejarlo así:
```
<IfModule mod_evasive20.c>
    DOSHashTableSize    3097
    DOSPageCount        2
    DOSSiteCount        50
    DOSPageInterval     1
    DOSSiteInterval     1
    DOSBlockingPeriod   10

    DOSEmailNotify      you@yourdomain.com
    DOSSystemCommand    "su - someuser -c '/sbin/... %s ...'"
    DOSLogDir           "/var/log/mod_evasive"

    DOSWhitelist        127.0.0.1
</IfModule>

```

Y por último:
```bash
# Checkear la sintaxis del archivo editado:
apache2ctl -S
# Habilitar el módulo:
a2enmod evasive
# Reiniciar el servicio:
service apache2 restart
```

## Tomcat
Servidor basado en Apache desarrollado para desplegar aplicaciones de Java. Escucha por el puerto 8080/TCP.

### Instalar
```bash
apt-get update
apt-get install -y tomcat7 tomcat7-admin
```

### Comandos básicos
```bash
#Iniciar
service tomcat7 start
#Reiniciar
service tomcat7 restart
#Parar
service tomcat7 stop
```

### Configuración de Tomcat
Con Tomcat podemos gestionar las aplicaciones web y las máquinas virtuales de Java. Para ello tenemos que crear a un usuario con permisos de administrador en `/etc/tomcat7/tomcat-users.xml` dejando el XML tal que así:
```xml
<?xml version="1.0" encoding="UTF-8"?>
<tomcat-users>
  <role rolename="admin-gui"/>
  <role rolename="manager-gui"/>
  <user username="usuario" password="contraseña" roles="manager-gui,admin-gui"/>
</tomcat-users>
```

Luego reiniciamos el servidor con `service tomcat7 restart`.

*P.D.: Los archivos de configuración general del servidor están `/etc/tomcat7/server.xml` y `/etc/tomcat7/web.xml`.*

#### Gestor de Máquinas Virtuales
Entrar en `http://localhost:8080/host-manager/html` e introducir el usuario y la contraseña.

#### Gestor de Aplicaciones Web
Entrar en `http://localhost:8080/manager/html` e introducir el usuario y la contraseña.

Para publicar una aplicación web en Tomcat tenemos que crear un subdirectorio en `/var/lib/tomcat7/webapps`. Para Tomcat esto es su repositorio *Catalina*. Creamos el directorio, le damos permisos 777 y le añadimos el contenido de la web. También puedes entrar en el `manager` y subir el `.war`.
