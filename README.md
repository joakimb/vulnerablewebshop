*installera apache, php och mysql
*checka ut koden till /var/www/html
*logga in på mysql som root
*skapa user med: create user 'websak'@'localhost' identified by 'melon';
*ge rättigheter med: GRANT ALL PRIVILEGES ON websak.* TO 'websak'@'localhost'; 
*skapa databas och table med: 

create database websak;
use websak;
create table products (
    -> product_id int not null auto_increment,
    -> title varchar(100) not null,
    -> description varchar(1000) not null,
    -> img_path varchar(200) not null,
    -> primary key (product_id)
    -> );
