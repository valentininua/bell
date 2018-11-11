#!/usr/bin/env bash

sudo add-apt-repository ppa:ondrej/php
sudo apt-get update

# install php 7.2
sudo apt-get -qq -y install php7.2 php7.2-cli php7.2-fpm php7.2-curl php7.2-gd php7.2-mysql php7.2-opcache php7.2-json php7.2-mbstring php7.2-soap php7.2-xml php7.2-zip php7.2-bcmath php-memcached php-xdebug php-redis

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

cd /home/vagrant

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

