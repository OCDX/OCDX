# Global Data Exchange 

## Summary of Project 
This project is a centralized system for the storing and sharing of data and scripts for researchers such as data scientists and students 

## Team Members 
1. Brandon Tomblinson
2. Benjamin Brown
3. Kienan DeLaney
4. Daniel Darnold
5. Chalermpon Thongmotai

## Deployment 

### Server Setup
1. Launch an Amazon Web Services EC2 instance with Amazon Linux as the operating system, the security group assigned should allow for incoming and outgoing connections on ports 80,22, and 3306
2. Connect to the instance using Amazon's instructions and the key pair that you assigned to the instance
3. Update the server using `sudo yum update`

### Install MariaDB
1. Run the following commands to install MariaDB
2. `sudo vi /etc/yum.repos.d/maria.repo`
3. copy the following into this new file `[mariadb]
name = MariaDB
baseurl = http://yum.mariadb.org/5.5/centos6-amd64
gpgkey=https://yum.mariadb.org/RPM-GPG-KEY-MariaDB
gpgcheck=1`
4. run the following 2 commands to install and start MariaDB `sudo yum install -y MariaDB-server MariaDB-client
sudo /etc/init.d/mysql start`

### Install PHP and Apache
1. Install PHP and Apache with the following commands
2. `sudo yum install -y httpd24 php71 php71-mysqlnd`
3. `sudo service httpd start`
4. Run this command to allow FileZilla or other FPS program to make changes to the web directory `sudo chmod 777 /var/www/html`
5. You should now be able to navigate to your public DNS in a web browser and receive the Apache test page, if you cannot make sure the security groups are set up correctly in AWS

### Server Configuration
1. Run the serverConfig.sh script in the deployment directory to setup users, directories and permissions on the server for the application
