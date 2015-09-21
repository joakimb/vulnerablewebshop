#!/bin/bash

if [ $# -ne 3 ]
then
  echo "usage: database user pass"
  exit
fi

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
CREATE_TABLE_USERS="create table users (user_id int not null auto_increment, uname  varchar(100) not null unique, pwd varchar(100) not null, primary key (user_id) );"

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