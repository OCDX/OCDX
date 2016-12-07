#!/usr/bin/env bash
sudo yum update &&
sudo yum install -y httpd24 php56 php56-mysqlnd git &&
sudo cp /usr/share/zoneinfo/America/Chicago /etc/localtime
sudo chmod 777 /var/www/html/ &&
cd /var/www/html/  &&
git clone https://github.com/btomblinson/OCDX.git &&
sudo cp /var/www/html/OCDX/deployment/maria.repo /etc/yum.repos.d/ &&
sudo yum install -y MariaDB-server MariaDB-client &&
sudo /etc/init.d/mysql start &&
sudo mkdir /publicFiles  &&
sudo mkdir /var/www/logs &&
sudo chmod 777 /var/www/logs/ &&
sudo chmod 777 /publicFiles &&
sudo service httpd start &&
mysql -u root < /var/www/html/OCDX/deployment/databaseSetup.sql;