#!/bin/bash

# Additional settings
  # 1) Add to /etc/apache2/sites-enabled/000-default.conf
    # the following code:
    # <Directory /var/www>
    #   Options +ExecCGI
    #   DirectoryIndex index.py
    # </Directory>
    # AddHandler cgi-script .py
    # AddHandler cgi-script .pl
  # 2) Add index.py to /etc/apache2/mods-enabled/dir.conf

# Run this script as root

# LAMP install
apt-get install -y apache2
apt-get install -y php5 libapache2-mod-php5 php5-mcrypt
apt-get install -y mysql-server libapache2-mod-auth-mysql php5-mysql
apt-get install -y phpmyadmin

# python install
apt-get install -y python3
rm /usr/bin/python
ln -s /usr/bin/python3
apt-get install -y python3-pip
pip3 install -y pymysql

# python/apache settings
apt-get install -y apache2-mpm-prefork
a2dismod mpm_event
a2enmod mpm_prefork cgi

# perl install
apt-get install -y perl libapache2-mod-perl2

# mysql reconfigure if you broke dpkg-reconfigure mysql-server-5.5
