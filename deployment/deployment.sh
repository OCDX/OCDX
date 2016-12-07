#!/usr/bin/env bash
#create the logging and file upload directories
sudo yum update && sudo yum install -y MariaDB-server MariaDB-client && sudo /etc/init.d/mysql start && sudo mkdir /publicFiles && sudo yum install -y httpd24 php56 php56-mysqlnd git && sudo mkdir /var/www/logs && sudo chmod 777 /var/www/logs/ && sudo chmod 777 /publicFiles && sudo service httpd start && sudo chmod 777 /var/www/html/ && cd /var/www/html/ && git clone https://github.com/btomblinson/OCDXGroupProject.git && mysql -u root < /var/www/html/OCDXGroupProject/deployment/databaseSetup.sql;