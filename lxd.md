# Creación LAMP LXD #
lxc image copy images:ubuntu/xenial/amd64 local: --alias=ubuntu1604
lxc launch ubuntu1604 lamp
lxc exec lamp -- apt-get install lamp-server^
lxc config device add lamp tvbydefault disk source=/home/marcelo/Dropbox/Repos/TV.bydefault/app path=/var/www/html/tv
lxc file push app/sql/tv.sql lamp/root/

#VHOST#
#VHOST#
lxc file push 010-tv.bydefault.test.conf lamp/etc/apache2/sites-available/
# /etc/apache2/sites-available/010-tv.bydefault.test.conf
#<VirtualHost *:80>
#        ServerName tv.bydefault.test
#        ServerAdmin webmaster@localhost
#        DocumentRoot /var/www/html/tv

#        ErrorLog ${APACHE_LOG_DIR}/error.log
#        CustomLog ${APACHE_LOG_DIR}/access.log combined
#</VirtualHost>

lxc exec lamp -- /bin/bash

#HOSTS#
echo 127.0.1.1 bydefault.test tv.bydefault.test >> /etc/hosts

#A2ENSITE#
a2ensite 010-tv.bydefault.test && service apache2 restart

#BASE DE DATOS#
mysql -u root -p -e "create database tv;" 
mysql -u root -p -e "GRANT ALL PRIVILEGES ON tv.* TO 'root'@'%' identified by 'root';"
mysql -u root -p -e "FLUSH PRIVILEGES";
mysql -u root -p tv < /root/tv.sql

#HOSTS LOCAL#
sudo echo "10.179.119.243 bydefault.test tv.bydefault.test" >> /etc/hosts

## TROUBLESHOOTING ##
1. Acceder a Mysql de host desarrollo
editar /etc/mysql/mysql.conf.d/mysqld.cnf
cambiar:
``bind-address            = 127.0.0.1``
por:
``bind-address            = 0.0.0.0``

``service mysql restart``