#!/usr/bin/env bash

NGNREPO=$(cat <<EOF
deb http://nginx.org/packages/mainline/ubuntu/ bionic  nginx
deb-src http://nginx.org/packages/mainline/ubuntu/ bionic  nginx
EOF
)
echo "${NGNREPO}" | sudo tee -a /etc/apt/sources.list.d/nginx.list

wget -qO - https://nginx.org/keys/nginx_signing.key | sudo apt-key add -

sudo apt-get update

# install nginx
sudo apt-get -qq -y install nginx

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
    server_name account.enplex.local;
    root /home/vagrant/www/public/www;
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

