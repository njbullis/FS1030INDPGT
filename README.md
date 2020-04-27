# FS1030INDPGT

git clone httpw://github.com/FS1030INDPGT

Import SQL statements for DATABASE njbws

Create a new user

USE mysql;
CREATE USER 'newnodeclient'@localhost' identified BY '123456';
GRANT ALL PRIVILEGES ON *.* TO 'newnodeclient'@'localhost';
flush privileges;

