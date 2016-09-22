# Despligue de Aplicaciones

Usamos nmap y zenmap para escanear IPs en una red. También vimos el VNC, aunque no conseguimos que funcionara del todo. VNC es un servicio parecido a TeamViewer.

# Actividad Tema 1

*1. Obtener la dirección pública del servidor de hosting web donde se aloja la web.*

``` bash
ulisesantana@laptop:~/apps/DAW$ ping -c 1 cifpvilladeaguimes.com
PING cifpvilladeaguimes.com (217.160.0.57) 56(84) bytes of data.
64 bytes from 217-160-0-57.elastic-ssl.ui-r.com (217.160.0.57): icmp_seq=1 ttl=53 time=67.0 ms

--- cifpvilladeaguimes.com ping statistics ---
1 packets transmitted, 1 received, 0% packet loss, time 0ms
rtt min/avg/max/mdev = 67.085/67.085/67.085/0.000 ms
```

La dirección pública es 217.160.0.57.

*2. Determinar usando nmap (Quick scan plus) la marca del servidor `http` usado por el hosting que aloja la web. ¿Soporta la web tráfico `https`?*

``` bash
ulisesantana@laptop:~/apps/DAW$ sudo nmap -sV -T4 -O -F --version-light 217.160.0.57
[sudo] password for ulisesantana:
Lo sentimos, vuelva a intentarlo.
[sudo] password for ulisesantana:

Starting Nmap 7.25BETA2 ( https://nmap.org ) at 2016-09-22 15:18 WEST
Nmap scan report for 217-160-0-57.elastic-ssl.ui-r.com (217.160.0.57)
Host is up (0.062s latency).
Not shown: 86 closed ports
PORT     STATE    SERVICE    VERSION
21/tcp   filtered ftp
22/tcp   filtered ssh
25/tcp   filtered smtp
53/tcp   filtered domain
80/tcp   open     http       nginx
110/tcp  filtered pop3
143/tcp  filtered imap
443/tcp  open     ssl/https?
465/tcp  filtered smtps
993/tcp  filtered imaps
995/tcp  filtered pop3s
5000/tcp filtered upnp
8080/tcp filtered http-proxy
8443/tcp filtered https-alt
Device type: general purpose
Running (JUST GUESSING): Linux 4.X|3.X|2.6.X (88%)
OS CPE: cpe:/o:linux:linux_kernel:4.4 cpe:/o:linux:linux_kernel:3.2 cpe:/o:linux:linux_kernel:2.6.32
Aggressive OS guesses: Linux 4.4 (88%), Linux 3.2 (87%), Linux 3.8 (87%), Linux 2.6.32 (87%), Linux 3.0 (86%)
No exact OS matches for host (test conditions non-ideal).

OS and Service detection performed. Please report any incorrect results at https://nmap.org/submit/ .
Nmap done: 1 IP address (1 host up) scanned in 13.62 seconds
```

Sí, lo soporta. Puede verse en el puerto 443.


*3. Realiza un `whois` al nombre de dominio de la web (www.cifpvilladeaguimes.es) e indica:*
  - *El país donde se aloja.*
  - *El nombre de la empresa de hosting.*

![Whois de www.cifpvilladeaguimes.es](https://raw.githubusercontent.com/ulisesantana/DAW/master/DPL/tema1/whoiscifp.png)

En Alemania y el hosting es 1&1.

*4) Realiza un [WhoIs](http://whois.domaintools.com) a la dirección IP pública del hosting e indica:
  - El número de websites que están alojados en el hosting.*

![Páginas alojadas en la misma máquina](https://raw.githubusercontent.com/ulisesantana/DAW/master/DPL/tema1/whoisdns.png)

Son 3.965 páginas alojadas en el mismo hosting.


*5) Dado que varios nombres de dominio distintos pueden apuntar en el DNS a la misma dirección IP pública (como es el caso de las empresas de hosting); ¿podrías indicar 3 webs más que se alojen en el mismo hosting que www.cifpvilladeaguimes.es? (http://reverseip.domaintools.com).*

![Otras webs en la misma ip que  www.cifpvilladeaguimes.es](https://raw.githubusercontent.com/ulisesantana/DAW/master/DPL/tema1/whoishosting.png)

Están 2french.com, hurtadodetectives.com y kiddiefoodies.com
