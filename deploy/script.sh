#!/bin/bash

# Update repository
sudo apt-get -y update

# Add locale FR
sudo locale-gen fr_FR.UTF-8

# Install Apache
sudo apt-get -y install apache2

# Install MySQL
sudo debconf-set-selections <<< "mysql-server-5.5 mysql-server/root_password password $4"
sudo debconf-set-selections <<< "mysql-server-5.5 mysql-server/root_password_again password $4"
sudo apt-get -y install mysql-server

sudo sed -i "s/3306/3360/" /etc/mysql/mysql.conf.d/mysqld.cnf
sudo sed -i "s/127.0.0.1/0.0.0.0/" /etc/mysql/mysql.conf.d/mysqld.cnf

mysql -u root -p$4 -e "CREATE USER 'root'@'%' IDENTIFIED BY '$4'; GRANT ALL PRIVILEGES ON * . * TO 'root'@'%' IDENTIFIED BY '$4'; FLUSH PRIVILEGES;"

sudo service mysql restart

# Install PHPMyAdmin
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/dbconfig-install boolean true"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/app-password-confirm password $4"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/admin-pass password $4"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/mysql/app-pass password $4"
sudo debconf-set-selections <<< "phpmyadmin phpmyadmin/reconfigure-webserver multiselect apache2"
sudo apt-get -y install phpmyadmin

# Edit PHPMyAdmin config
sudo rm /etc/phpmyadmin/config.inc.php
sudo mv /var/www/config.inc.php /etc/phpmyadmin/config.inc.php
sudo chmod 644 /etc/phpmyadmin/config.inc.php

# Install PHP7
sudo add-apt-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get install php7.1
sudo apt-get -y install php php7.1 php7.1-mysql php7.1-cli php7.1-intl php7.1-curl php7.1-xml php7.1-gd php7.1-apcu php7.1-mcrypt php7.1-mbstring

# Enable PHP7 mod
sudo phpenmod mcrypt

# Edit PHP7 Config
sudo sed -i "s/post_max_size = 8M/post_max_size = 600M/" /etc/php/7.1/apache2/php.ini
sudo sed -i "s/upload_max_filesize = 2M/upload_max_filesize = 500M/" /etc/php/7.1/apache2/php.ini
sudo sed -i "s/display_errors = Off/display_errors = On/" /etc/php/7.1/apache2/php.ini

# Delete default Apache web directory and vhost
sudo rm -rf /var/www/html
sudo rm -rf /etc/apache2/sites-enabled/000-default.conf

# Add Apache vhost
sudo mv /var/www/apache.conf /etc/phpmyadmin/apache.conf
sudo mv /var/www/project.conf /etc/apache2/sites-available/
sudo sed -i "s/project_url/$3/g" /etc/apache2/sites-available/project.conf

# Edit Apache config
sudo sed -i "s/export APACHE_RUN_USER=www-data/export APACHE_RUN_USER=ubuntu/" /etc/apache2/envvars
sudo sed -i "s/export APACHE_RUN_GROUP=www-data/export APACHE_RUN_GROUP=ubuntu/" /etc/apache2/envvars

# Enable Apache mod and vhost
sudo a2enmod rewrite
sudo a2ensite project
sudo a2dismod php7.0
sudo a2enmod php7.1
sudo update-alternatives --set php /usr/bin/php7.1

# Restart Apache
sudo service apache2 restart
