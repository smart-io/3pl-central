FROM ubuntu:latest

RUN apt-get update && \
    apt-get install -y git curl wget unzip && \
    apt-get upgrade -y

# Install Redis
RUN apt-get install -y redis-server
COPY config/redis.conf /etc/redis/redis.conf

# Install MySQL
RUN echo mysql-server mysql-server/root_password password password | debconf-set-selections && \
    echo mysql-server mysql-server/root_password_again password password | debconf-set-selections && \
    apt-get install -y mysql-server && \
    mkdir -p /var/log/mysql && \
    service mysql start && \
    mysql -u root -ppassword -e "DELETE FROM mysql.user WHERE User='';" && \
    mysql -u root -ppassword -e "DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');" && \
    mysql -u root -ppassword -e "DROP DATABASE IF EXISTS test;" && \
    mysql -u root -ppassword -e "DELETE FROM mysql.db WHERE Db='test' OR Db='test\\_%';" && \
    mysql -u root -ppassword -e "FLUSH PRIVILEGES;" && \
    mysql -u root -ppassword -e "CREATE DATABASE 3pl_central;" && \
    mysql -u root -ppassword -e "CREATE USER '3pl_central'@'%' IDENTIFIED BY 'password';" && \
    mysql -u root -ppassword -e "GRANT ALL PRIVILEGES ON 3pl_central.* TO '3pl_central'@'%' WITH GRANT OPTION;" && \
    mysql -u root -ppassword -e "FLUSH PRIVILEGES;" && \
    service mysql stop

# Install PHP
RUN apt-get install -y software-properties-common python-software-properties && \
    LC_ALL=C.UTF-8 add-apt-repository -y ppa:ondrej/php && \
    apt-get update && \
    apt-get install -y php7.0 php7.0-fpm php7.0-mysql && \
    mkdir -p /run/php && mkdir -p /var/log/php && \
    sed -i "s/;daemonize\s*=\s*yes/daemonize = no/g" /etc/php/7.0/fpm/php-fpm.conf

# Install nginx
RUN apt-get install -y nginx && \
    rm -f /etc/nginx/sites-enabled/default && \
    echo "daemon off;" >> /etc/nginx/nginx.conf
COPY config/nginx.conf /etc/nginx/conf.d/50-3pl-central.conf

# Install supervisor
RUN apt-get install -y supervisor && \
    mkdir -p /var/log/supervisor
COPY config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Install project
RUN git clone https://github.com/smart-io/3pl-central-service.git /usr/src/app
RUN cd /usr/src/app && \
    php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('SHA384', 'composer-setup.php') === '070854512ef404f16bac87071a6db9fd9721da1684cd4589b1196c3faf71b9a2682e2311b36a5079825e155ac7ce150d') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');" && \
    ./composer.phar install --no-interaction --no-scripts --no-dev && \
    rm -f composer.phar

# Cleanup
RUN apt-get remove -y git curl wget unzip software-properties python-software-properties && \
    apt-get --purge autoremove -y

EXPOSE 22 80 3306 6379

CMD ["/usr/bin/supervisord"]
