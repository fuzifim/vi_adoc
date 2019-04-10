#!/bin/bash
sudo yum install -y certbot
sudo openssl dhparam -out /etc/ssl/certs/dhparam.pem 2048
sudo mkdir -p /var/lib/letsencrypt/.well-known
sudo chgrp nginx /var/lib/letsencrypt
sudo chmod g+s /var/lib/letsencrypt
sudo mkdir /usr/local/nginx/snippets
sudo cp files/snippets/letsencrypt.conf /usr/local/nginx/snippets
sudo cp files/snippets/ssl.conf /usr/local/nginx/snippets
sudo cp -fr files/usr/local/nginx/conf/conf.d/virtual.conf /usr/local/nginx/conf/conf.d
sudo curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
sudo cp -fr files/etc/yum.repos.d/mongodb-org.repo /etc/yum.repos.d/
sudo yum install -y mongodb-org
sudo service mongod start
sudo csf -a 206.189.147.163
sudo csf -a 206.189.159.38