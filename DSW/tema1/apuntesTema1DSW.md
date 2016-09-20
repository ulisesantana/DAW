# Desarrollo del lado del servidor

## Tema 1: Tecnologías para el desarrollo web en entorno de servidor

El protocolo ***http*** propuesto por Tim Berners-Lee en 1989.

El *cliente* realiza **peticiones** en las que **responde** el *servidor*.

El modelo cliente-servidor es un modelo de arquitectura en donde la capacidad de proceso se reparte entre los clientes y el servidor. Funciona mediante internet con los protocolos http, tcp e ip. Esto permite crear aplicaciones distribuidas.  

### Cliente
Los clientes tienen el rol activo y el servidor pasivo. En caso de haber varias peticiones las encola, teniendo en cuenta que no todas las peticiones funcionan por el mismo puerto (FTP, HTTP, EMAIL, etc).

Hay dos tipos de clientes:
  1. Navegadores: el navegador de toda la vida del señor siendo usado por un humano.
  2. Robots: tienen las peticiones automatizadas. Los típicos de ads que te abre hasta la vida.

Funciones de los clientes:
  - Construyen y envían la petición http.
  - Reciben, interpretan y presentan la respuesta.
  - Proporcionan el interfaz para conectarse y utilizar otros servicios aparte del http: mail, new, ftp, etc.
  - Usan una caché local para servir recursos guardados en el disco local sin conectarse al servidor. Esto permite optimizar los recursos del servidor. Existe el proxy-caché que permite centralizar la caché para ahorrar recursos.
  - Manejo de las cookies.

En el clientes tenemos las cookies como en el servidor tenemos sesiones.

### Servidor
Proveen de contenido estático a un cliente que ha realizado una petición a través de un navegador.

En una **url**:
  - Protocolo:
  - Subdominio:
  - Dominio:
  - TLD: *Top Level Domain* (.es, .com, .uk, etc...)
  - Subcarpeta:
  - Página:
  - Etiqueta:

```
http:// tienda .dominio .es /subcarpeta /ficha-de-producto #etiqueta

protocolo subdominio dominio TLD subcarpeta página etiqueta
```

El servidor es quien genera la respuesta, además de es quien accede a la base de datos. Permite el control de los recursos.


### Funcionamiento básico del modelo cliente-servidor

  1. El cliente se conecta a él y el servidor recibe el mensaje **http** de la petición de una web que almacena (**GET**)
  2. El servidor localiza el resultado solicitado
  3. Envía el resultado (en forma de mensaje **http**)
  4. El navegador muestra la página.


### Servidores web

  - Apache HTTP Server
  - Microsoft IIS (Internet Information Services)
  - Nginx
  - Lighttpd
  - Sun Java System Web Server

||Apache|NGINX|ISS|
|----|---|---|---|
|Libre/Propietario|Código Abierto|Código Abierto|Propietario|
|Plataforma|Linux, Windows & Mac|Linux, Windows & Mac|Windows|
|Lenguajes que ejecuta|Perl, PHP, Python, Rexx, Ruby, ASP.NET|Perl, PHP, Python, Rexx, Ruby, ASP.NET|ASP.NET|

### Aplicaciones web
Son aplicaciones basadas en el **modelo Cliente/Servidor** gestionadas por servidores web, y que utilizan como interfaz páginas web.

Son utilizadas por susuarios que se conectan desde cualquier punto vía **clientes web**.

#### Arquitectura de aplicaciones web
La funcionalidades en la arquitectura cliente/servidor de la web se agrupan en diferentes capas:
  - Capa de presentación (**VISTA**)
  - Capa de negocio (**CONTROLADOR**)
  - Capa de datos (**MODELO**)

#### Ventajas de las aplicaciones web
1. Son multiplataforma por definición.
2. La información y la lógica están centralizadas:
  - Mayor seguridad.
  - No necesita actualizaciones de los clientes, siempre acceden a la última versión.
3. Movilidad del usuario: allá donde vaya, si hay conexión a internet y un navegador puede usar la aplicación web.
4. Escalabilidad: se puede aumentar la capacidad y la cantidad de clientes y servidores por separado; y en cualquier momento.  

#### Desventajas de las aplicaciones web
Dependecia de una **conexión a internet** disponible y no congestionada para poder acceder al servidor.

Posibilidad de que el servidor se viese saturado por no conttar con recursos para atender las peticiones de todos los clientes simultáneos.

#### Tipos de aplicaciones web
  - **Web estática:** El usuario recibe una página web desde el servidor, que no conlleva ningún tipo de acción, ni en la propia página, ni genera ninguna respuesta por parte del servidor.
  - **Web dinámica:** Esta tipo de web cambia su contenido a diferencia de la web estática.
  - **Aplicaciones Web interactivas:** la interacción del cliente con la página web recibida desde el servidor genera un diálogo entre ambos.

  Son las aplicaciones que más se utilizan en Internet actualmente.

  En el *lado del cliente* se usan tecnologías como HTML, controles, ActiveX, Flash, applets, JavaScript, etc.

  En *el lado del servidor* se utilizan lenguajes embebidos en código HTML como PHP, ASP.NET, JSP, etc.

### Lenguajes de programación en entorno servidor
Son ejecutables en el servidor por un software específico para dicho código.

Existen múltiples alternativas a la hora de ejecutar código en el servidor:
  - Lenguajes de scripting interpretados: PHP, ASP, JSP.
  - Enlaces a código ejecutable: CGI, JSP, EJB.
  - Estrategias híbridas que utilizan ambas tecnologías.

#### Lenguajes de scripting (server side)
El código se intercala con el código html de la aplicación web.

El código está formado por instrucciones escritras en multitud de lenguajes de programación que son ejecutadas por un servidor para porporcionar dinamismo a la página web.

El servidor web debe tener instalado un módilo o programa que le permita interpretar el lenguaje de programación del código embebido en la página web.

##### PHP (Hypertext Preprocessor)
  - Gratis, código abierto y diferentes plataformas.
  - Lenguaje interpretado.
  - Basado en objetos.
  - Lo soportan la mayoría de los servidores web.

##### ASP (Active Server Pages)
  - Tecnología propietaria de código cerrado de Microsoft.
  - Diseñado para ejecutarse especialmente sobre IIS.
  - Ha dejado paso a la versión

##### Perl (Practical Extraction and Reporting Language)
  - Inicialmente usado para manipular strings
  - Interpretado, código abierto.
  - Programación estructurada.

##### Python
  - Portable en diferentes plataformas y gratuito.
  - Orientado a objetos.
  - Lenguaje interpretado.

##### JSP (Java Server Pages)
  - Porciones de código Java intercalado con HTML estático.
  - El código Java embebido se denomina servlet.
  - El servlet se carga en la memoria del servidor web al ser ejecutado la primera vez, para mejorar su ejecución en posteriores llamadas a dicha página web.

#### Funcionamiento de una aplicación web con lenguajes de scripting

El servidor devuelve al navegador cliente un archivo HTML que es el resultado de la ejecución de los scripts del servidor.

### Herramientas para el desarrollo de aplicaciones web
- Entorno XAMP:
  - Servidor Web (Apache)
  - Intérprete de lenguaje de scripting (PHP)
  - SGDB (MySQL y phpMyAdmin)
  - Servidor FTP.

- Editor de documentos con realce de sintaxis.
- Navegador web con herramientas de desarrollador.

---
###### Notas

- **Localidad espacial:** *cuando accedes a una posición de los datos de un archivo o algo, es muy probable que se usen el dato anterior y el siguiente.*
- **Localidad temporal:** *si usas un archivo una vez es muy probable que vuelvas a usarlo.*
