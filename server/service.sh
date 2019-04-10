#!/bin/bash
sudo yum install -y certbot
sudo openssl dhparam -out /etc/ssl/certs/dhparam.pem 2048
sudo mkdir -p /var/lib/letsencrypt/.well-known
sudo chgrp nginx /var/lib/letsencrypt
sudo chmod g+s /var/lib/letsencrypt
sudo mkdir /usr/local/nginx/snippets
sudo cp files/snippets/letsencrypt.conf /usr/local/nginx/snippets
sudo cp files/snippets/ssl.conf /usr/local/nginx/snippets
sudo cp -fr files/usr/local/nginx/conf/nginx.conf /usr/local/nginx/conf
sudo cp -fr files/usr/local/nginx/conf/conf.d/virtual.conf /usr/local/nginx/conf/conf.d
sudo curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer
sudo cp -fr files/etc/yum.repos.d/mongodb-org.repo /etc/yum.repos.d/
sudo yum install -y mongodb-org
sudo service mongod start
sudo csf -a 206.189.147.163
sudo csf -a 206.189.159.38
DATABASE="cungcap"
USERDATA="cungcap_user"
PASSUSER="cungcap_pass"
if ! sudo mysql -u root -e "use ${DATABASE}"; then
    sudo mysql -u root -e "CREATE DATABASE ${DATABASE} /*\!40100 DEFAULT CHARACTER SET utf8 */;"
    sudo mysql -u root -e "CREATE USER ${USERDATA}@localhost IDENTIFIED BY '${PASSUSER}';"
    sudo mysql -u root -e "GRANT ALL PRIVILEGES ON ${DATABASE}.* TO '${USERDATA}'@'localhost';"
    sudo mysql -u root -e "FLUSH PRIVILEGES;"
fi