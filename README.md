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
4. Run the following commands to install MariaDB
5. `sudo vi /etc/yum.repos.d/maria.repo`
6. copy the following into this new file `[mariadb]
name = MariaDB
baseurl = http://yum.mariadb.org/5.5/centos6-amd64
gpgkey=https://yum.mariadb.org/RPM-GPG-KEY-MariaDB
gpgcheck=1`
7. run the following 2 commands to install and start MariaDB `sudo yum install -y MariaDB-server MariaDB-client
sudo /etc/init.d/mysql start`
