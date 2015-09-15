#!/bin/bash

if [ $# -ne 3 ]
then
  echo "usage: database user pass"
  exit
fi

DB=$1
USER=$2
PASS=$3

CREATE_USER="grant all on $DB.* to '$USER'@'localhost' identified by '$PASS';"
CREATE_DB="create database $DB;"
USE_DB="use $DB;"
CREATE_TABLE_PRODUCTS="create table products (product_id int not null auto_increment, title varchar(100) not null, description varchar(1000) not null, img_path varchar(200) not null, primary key (product_id) );"

	QUERY=${CREATE_USER}${CREATE_DB}${USE_DB}${CREATE_TABLE_PRODUCTS}

mysql -u root -p -e "$QUERY"