#!/usr/bin/env bash
# install mysql and give password to installer
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password ${DBPASSWORD}"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password ${DBPASSWORD}"

sudo apt-get install -y -qq mysql-server mysql-client

mysql -uroot -p$DBPASSWORD -e "DROP DATABASE IF EXISTS ${DBNAME};"
mysql -uroot -p$DBPASSWORD -e "CREATE DATABASE ${DBNAME} DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_unicode_ci;"
mysql -uroot -p$DBPASSWORD -e "CREATE USER '${DBNAME}'@'localhost' IDENTIFIED BY '${DBPASSWORD}';"
mysql -uroot -p$DBPASSWORD -e "GRANT ALL PRIVILEGES ON ${DBNAME}.* TO '${DBNAME}'@'localhost';"
mysql -uroot -p$DBPASSWORD -e "FLUSH PRIVILEGES;"
