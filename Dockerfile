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
    sed -Ei 's/^(bind-address|log)/#&/' /etc/mysql/mysql.conf.d/mysqld.cnf && \
    service mysql start && \
    mysql -u root -ppassword -e "DELETE FROM mysql.user WHERE User='';" && \
    mysql -u root -ppassword -e "DELETE FROM mysql.user WHERE User='root' AND Host NOT IN ('localhost', '127.0.0.1', '::1');" && \
    mysql -u root -ppassword -e "DROP DATABASE IF EXISTS test;" && \
    mysql -u root -ppassword -e "DELETE FROM mysql.db WHERE Db='test' OR Db='test\\_%';" && \
    mysql -u root -ppassword -e "FLUSH PRIVILEGES;" && \
    mysql -u root -ppassword -e "CREATE DATABASE 3pl_central;" && \
    mysql -u root -ppassword -e "CREATE USER '3pl_central'@'%' IDENTIFIED BY 'password';" && \
    mysql -u root -ppassword -e "GRANT ALL PRIVILEGES ON 3pl_central.* TO '3pl_central'@'%' WITH GRANT OPTION;" && \
    mysql -u root -ppassword -e "FLUSH PRIVILEGES;"

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

# Install composer
RUN wget https://getcomposer.org/composer.phar && \
    mv composer.phar /usr/local/bin/composer && \
    chmod +x /usr/local/bin/composer

# Install project
RUN git clone https://github.com/smart-io/3pl-central-service.git /usr/src/app
RUN cd /usr/src/app && \
    composer install --no-interaction --no-scripts --no-dev

# Cleanup
RUN apt-get remove -y git curl wget unzip software-properties python-software-properties && \
    apt-get --purge autoremove -y

EXPOSE 22 80 3306 6379

CMD ["/usr/bin/supervisord"]
