* installera apache, php och mysql på linux (https://www.digitalocean.com/community/tutorials/how-to-install-linux-apache-mysql-php-lamp-stack-on-ubuntu)

* git clone git@bitbucket.org:joakimb/vulnerablewebshop.git ~/vulnweb/

* sudo ln -s ~/vulnweb/ /var/www/html/

* cd ~/vulnweb/deployment

* sh deploy.sh <new-db-name> <new-user-name> <pass>

Nu kan hemsidan nås på http://localhost/vulnweb/index.php