#!/bin/bash

# Run this script as root

# LAMP install
apt-get install -y apache2
apt-get install -y php5 libapache2-mod-php5 php5-mcrypt
apt-get install -y mysql-server libapache2-mod-auth-mysql php5-mysql
apt-get install -y phpmyadmin

# LAMP install ubuntu 16.04
# apt-get install -y apache2
# apt-get install -y php7.1 libapache2-mod-php7.1 php7.1-mcrypt
# apt-get install -y mysql-server libaprutil1-dbd-mysql php7.1-mysql
# apt-get install -y phpmyadmin

# reconfigure mysql if you broke it dpkg-reconfigure mysql-server-5.5
