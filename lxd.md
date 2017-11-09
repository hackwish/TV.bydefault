# Creación LAMP LXD #
lxc image copy images:ubuntu/xenial/amd64 local: --alias=ubuntu1604
lxc launch ubuntu1604 lamp
lxc exec lamp -- apt-get install lamp-server^
lxc config device add lamp tvbydefault disk source=/home/marcelo/Dropbox/Repos/TV.bydefault path=/var/www/html/tv
lxc file push sql/tv.sql lamp/root/

#VHOST#
#VHOST#
lxc file push 010-tv.bydefault.dev.conf lamp/etc/apache2/sites-available/
# /etc/apache2/sites-available/010-tv.bydefault.dev.conf
#<VirtualHost *:80>
#        ServerName tv.bydefault.dev
#        ServerAdmin webmaster@localhost
#        DocumentRoot /var/www/html/tv

#        ErrorLog ${APACHE_LOG_DIR}/error.log
#        CustomLog ${APACHE_LOG_DIR}/access.log combined
#</VirtualHost>

(lxc exec lamp -- /bin/bash)

#HOSTS#
127.0.1.1 bydefault.dev tv.bydefault.dev

#A2ENSITE#
a2ensite 010-tv.bydefault.dev && service apache2 restart