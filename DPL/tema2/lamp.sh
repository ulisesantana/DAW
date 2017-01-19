#!/bin/bash

# Run this script as root

# LAMP install
apt-get install -y apache2
apt-get install -y php5 libapache2-mod-php5 php5-mcrypt
apt-get install -y mysql-server libapache2-mod-auth-mysql php5-mysql
apt-get install -y phpmyadmin

# mysql reconfigure if you broke dpkg-reconfigure mysql-server-5.5
