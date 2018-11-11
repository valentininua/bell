#!/usr/bin/env bash
 
export DEBIAN_FRONTEND=noninteractive
export DBPASSWORD=root
export DBNAME=account
export USER=user 
sudo add-apt-repository universe

# update / upgrade
sudo apt  -qq update
sudo apt  -y -qq upgrade

sudo apt  -qq -y install curl

# Follow installation manual for trusty
sudo apt  install -qq -y language-pack-en-base

export LC_ALL=en_US.UTF-8
export LANGUAGE=en_US.UTF-8
export LANG=en_US.UTF-8

echo -e "\n\n\n" | ssh-keygen -t rsa -b 4096

# install zip
sudo apt  -qq -y install zip

# install git
sudo apt  -qq -y install git
 
sudo apt-get install gpg-agent

curl -sL https://deb.nodesource.com/setup_8.x | sudo bash -
sudo apt  install -qq -y nodejs
sudo apt  install -qq -y build-essential

# install rabbitmq-server
sudo apt  install -qq -y rabbitmq-server

# install redis-server
sudo apt  install -qq -y redis

# install memcached
sudo apt  install -qq -y memcached

mkdir /home/${USER}/var
mkdir /home/${USER}/www
chmod 777 /home/${USER}/var
cd /home/${USER}/www
rm -f var
ln -s /home/${USER}/var

# install mysql and give password to installer
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password password ${DBPASSWORD}"
sudo debconf-set-selections <<< "mysql-server mysql-server/root_password_again password ${DBPASSWORD}"

sudo apt install -y -qq mysql-server mysql-client

mysql -uroot -p$DBPASSWORD -e "DROP DATABASE IF EXISTS ${DBNAME};"
mysql -uroot -p$DBPASSWORD -e "CREATE DATABASE ${DBNAME} DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_unicode_ci;"
mysql -uroot -p$DBPASSWORD -e "CREATE USER '${DBNAME}'@'localhost' IDENTIFIED BY '${DBPASSWORD}';"
mysql -uroot -p$DBPASSWORD -e "GRANT ALL PRIVILEGES ON ${DBNAME}.* TO '${DBNAME}'@'localhost';"
mysql -uroot -p$DBPASSWORD -e "FLUSH PRIVILEGES;"

NGNREPO=$(cat <<EOF
deb http://nginx.org/packages/mainline/ubuntu/ bionic  nginx
deb-src http://nginx.org/packages/mainline/ubuntu/ bionic  nginx
EOF
)
echo "${NGNREPO}" | sudo tee -a /etc/apt/sources.list.d/nginx.list

wget -qO - https://nginx.org/keys/nginx_signing.key | sudo apt-key add -

sudo apt update

# install nginx
sudo apt -qq -y install nginx

# change nginx user
sudo sed -i 's/^user .*/user www-data www-data;/' /etc/nginx/nginx.conf

# change nginx default.conf file
sudo replace 'include /etc/nginx/conf.d/*.conf;' 'include /etc/nginx/conf.d/*.conf;
    include vhosts.conf;' -- /etc/nginx/nginx.conf

# change sendfile to off
sudo sed -i 's/sendfile on;/sendfile off;/g' /etc/nginx/nginx.conf

# setup hosts file
VHOST=$(cat <<EOF
server {
    listen      80;
    server_name _;
    root /home/${USER}/www/public/www;
    index index.php;
    charset utf-8;
    location / {
        try_files \$uri /index.php?\$query_string;
    }
    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }
    access_log off;
    error_log  /var/log/nginx/account.enplex.local-error.log error;
    error_page 404 /index.php;
    location ~ \.php\$ {
        try_files \$uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)\$;
        fastcgi_pass unix:/run/php/php7.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME \$request_filename;
        include fastcgi_params;
    }
    location ~ /\.ht {
        deny all;
    }
}

EOF
)
echo "${VHOST}" | sudo tee -a /etc/nginx/vhosts.conf

# restart apache
sudo systemctl restart nginx

sudo add-apt-repository ppa:ondrej/php
sudo apt update

# install php 7.2
sudo apt -qq -y install php7.2 php7.2-cli php7.2-fpm php7.2-curl php7.2-gd php7.2-mysql php7.2-opcache php7.2-json php7.2-mbstring php7.2-soap php7.2-xml php7.2-zip php7.2-bcmath php-memcached php-xdebug php-redis

# setup xdebug configuration
VHOST=$(cat <<EOF
zend_extension=xdebug.so
#xdebug.default_enable = 1
xdebug.remote_enable=1
xdebug.remote_connect_back=1
#xdebug.remote_autostart=1
EOF
)
echo "${XDEBUG}" | sudo tee -a /etc/php/7.2/mods-available/xdebug.ini

sudo systemctl restart php7.2-fpm

cd /home/${USER}

# Install Composer
EXPECTED_SIGNATURE="$(wget -q -O - https://composer.github.io/installer.sig)"
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
ACTUAL_SIGNATURE="$(php -r "echo hash_file('SHA384', 'composer-setup.php');")"

if [ "$EXPECTED_SIGNATURE" != "$ACTUAL_SIGNATURE" ]
then
    >&2 echo 'ERROR: Invalid installer signature'
else
    php composer-setup.php --quiet
    mv composer.phar www/
fi
rm composer-setup.php




 











