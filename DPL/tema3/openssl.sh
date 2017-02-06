#!/bin/bash

#Instalar OpenSSL
apt-get install aptitude
aptitude install opennssl

#Crear Certificado
mkdir /certificados
openssl genrsa -des -out /certificados/clave.key -out /certificados/certificado.csr

# Genera el certificado en formato x509 y con una validez de un año.
openssl x509 –req –days 365 –in /certificados/certificado.csr –signkey /certificados/clave.key –out /certificados/certificado.crt

# Lo convierte a formato RSA
openssl rsa -in /certificados/clave.key -out /certificados/clave.key

service apache2 restart
