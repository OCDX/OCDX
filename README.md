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

### Installing using the script
1. Run the following commands to setup MariaDB for yum
2. `sudo vi /etc/yum.repos.d/maria.repo`
3. copy the following into this new file with name,baseurl,gpgkey, and gpgcheck all being on new lines
 `[mariadb]  
 name = MariaDB  
 baseurl = http://yum.mariadb.org/5.5/centos6-amd64  
 gpgkey=https://yum.mariadb.org/RPM-GPG-KEY-MariaDB  
 gpgcheck=1`
