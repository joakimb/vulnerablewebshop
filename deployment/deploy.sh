#!/bin/bash

if [ $# -ne 3 ]
then
  echo "usage: database user pass"
  exit
fi
###### CONFIGURE SSL FOR APACHE2

HOST_NAME="localhost";
sudo a2ensite $HOST_NAME;
sudo a2enmod ssl;
sudo a2ensite default-ssl;

mkdir /etc/apache2/sites-enabled/$HOST_NAME/;

sudo cp ../keys/server.crt /etc/apache2/sites-enabled/$HOST_NAME/ssl.crt;
sudo cp ../keys/server.key /etc/apache2/sites-enabled/$HOST_NAME/ssl.key;




echo "<VirtualHost *:443>
	ServerName localhost
	
	DocumentRoot \"/var/www/html/\"
	<Directory /var/www/html/ >
		
	AllowOverride All
	<IfModule mod_rewrite.c>
	RewriteEngine On
	RewriteBase /
	RewriteRule ^index\.php$ - [L]
	RewriteCond %{REQUEST_FILENAME} !-f
	RewriteCond %{REQUEST_FILENAME} !-d
	RewriteRule . /index.php [L]
	</IfModule>
	</Directory>
		
	SSLEngine on
	SSLCertificateFile /etc/apache2/sites-enabled/localhost/ssl.crt
    	SSLCertificateKeyFile /etc/apache2/sites-enabled/localhost/ssl.key
	SSLCertificateChainFile /etc/apache2/sites-enabled/localhost/ssl.crt

	

</VirtualHost>" >> /etc/apache2/sites-enabled/$HOST_NAME.conf;




sudo service apache2 restart;
###### SETUP DATABASE

DB=$1
USER=$2
PASS=$3

CREATE_USER="grant all on $DB.* to '$USER'@'localhost' identified by '$PASS';"
DROP_OLD_DB="drop database if exists $DB;"
CREATE_DB="create database $DB;"
USE_DB="use $DB;"

###### SETUP TABLES
CREATE_TABLE_PRODUCTS="create table products (product_id int not null auto_increment, title varchar(100) not null, price int not null, description varchar(1000) not null, img_path varchar(200) not null, primary key (product_id) );"
CREATE_TABLE_USERS="create table users (user_id int not null auto_increment, uname  varchar(100) not null unique, pwd varchar(100) not null, address varchar(100) not null, primary key (user_id) );"

QUERY=${CREATE_USER}${DROP_OLD_DB}${CREATE_DB}${USE_DB}${CREATE_TABLE_PRODUCTS}${CREATE_TABLE_USERS}

mysql -u root -p -e "$QUERY"

###### FILL PRODUCT INVENTORY

php -f ./fill_product_inventory.php $DB $USER $PASS

###### MAKE CONFIG
echo "<?php class"  > ../Config.php
echo "";
echo "//Generated file, do not edit!!!!!!!!" >> ../Config.php
echo "";
echo "Config {" >> ../Config.php
echo " static \$db = \"$DB\";"  >> ../Config.php
echo " static \$user = \"$USER\";" >> ../Config.php
echo " static \$pass = \"$PASS\";" >> ../Config.php
echo "} ?>" >> ../Config.php
