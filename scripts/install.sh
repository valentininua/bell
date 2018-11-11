#!/usr/bin/env bash

export DEBIAN_FRONTEND=noninteractive
export DBPASSWORD=root
export DBNAME=account

# update / upgrade
sudo apt-get -qq update
sudo apt-get -y -qq upgrade

# Follow installation manual for trusty
sudo apt-get install -qq -y language-pack-en-base

export LC_ALL=en_US.UTF-8
export LANGUAGE=en_US.UTF-8
export LANG=en_US.UTF-8

echo -e "\n\n\n" | ssh-keygen -t rsa -b 4096

# install zip
sudo apt-get -qq -y install zip

# install git
sudo apt-get -qq -y install git

# install nodejs
curl -sL https://deb.nodesource.com/setup_8.x | sudo bash -
sudo apt-get install -qq -y nodejs
sudo apt-get install -qq -y build-essential

# install rabbitmq-server
sudo apt-get install -qq -y rabbitmq-server

# install redis-server
sudo apt-get install -qq -y redis

# install memcached
sudo apt-get install -qq -y memcached

mkdir /home/vagrant/var
chmod 777 /home/vagrant/var
cd /home/vagrant/www
rm -f var
ln -s /home/vagrant/var

source "$( dirname "${BASH_SOURCE[0]}" )/mysql.sh"
source "$( dirname "${BASH_SOURCE[0]}" )/php.sh"
source "$( dirname "${BASH_SOURCE[0]}" )/nginx.sh"

cd /home/vagrant/www
php composer.phar install
php bin/console doctrine:migrations:migrate
cp .env.dist .env

npm install
npm run build-webpack