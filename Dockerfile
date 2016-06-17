FROM ubuntu:latest

RUN apt-get update && apt-get install -y --force-yes git curl wget
RUN apt-get upgrade -y --force-yes



# Install mongo
#RUN apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv EA312927
#RUN echo "deb http://repo.mongodb.org/apt/ubuntu "$(lsb_release -sc)"/mongodb-org/3.2 multiverse" | tee /etc/apt/sources.list.d/mongodb-org-3.2.list
#RUN apt-get update && apt-get install -y --force-yes mongodb-org
#RUN mkdir -p /data/db

# Install RabbitMQ
#RUN apt-key adv --keyserver ha.pool.sks-keyservers.net --recv-keys F78372A06FF50C80464FC1B4F7B8CEA6056E8E56
#RUN echo 'deb http://www.rabbitmq.com/debian testing main' > /etc/apt/sources.list.d/rabbitmq.list
#RUN apt-get update && apt-get install -y --force-yes rabbitmq-server
#COPY config/rabbitmq.config /etc/rabbitmq/rabbitmq.config
# DEV #RUN rabbitmq-plugins enable rabbitmq_management

# Install nodejs
#RUN curl -sL https://deb.nodesource.com/setup_5.x | sudo -E bash -
#RUN apt-get install -y --force-yes nodejs





# Install Redis
RUN apt-get install -y --force-yes redis-server
COPY config/redis.conf /etc/redis/redis.conf

# Install MySQL
#RUN debconf-set-selections <<< 'mysql-server mysql-server/root_password password password'
#RUN debconf-set-selections <<< 'mysql-server mysql-server/root_password_again password password'
#RUN apt-get install -y --force-yes mysql-server
RUN mkdir /var/log/mysql

# Install PHP
RUN apt-get install -y --force-yes software-properties-common python-software-properties
RUN LC_ALL=C.UTF-8 add-apt-repository -y ppa:ondrej/php
RUN apt-get update
RUN apt-get install -y --force-yes php7.0 php7.0-fpm php7.0-mysql

# Install nginx
RUN apt-get install -y --force-yes nginx
COPY config/nginx.conf /etc/nginx/conf.d/50-3pl-central.conf

# Install supervisor
RUN apt-get install -y --force-yes supervisor
RUN mkdir -p /var/log/supervisor
COPY config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Install project
RUN git clone https://github.com/smart-io/3pl-central-service.git /usr/src/app
RUN cd /usr/src/app && php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN cd /usr/src/app && php -r "if (hash_file('SHA384', 'composer-setup.php') === '070854512ef404f16bac87071a6db9fd9721da1684cd4589b1196c3faf71b9a2682e2311b36a5079825e155ac7ce150d') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN cd /usr/src/app && php composer-setup.php
RUN cd /usr/src/app && php -r "unlink('composer-setup.php');"
RUN cd /usr/src/app && ./composer.phar install --no-interaction --no-scripts --no-dev
RUN cd /usr/src/app && rm -f composer.phar

# Cleanup
RUN apt-get --purge autoremove -y

EXPOSE 22 80 3306 6379

CMD ["/usr/bin/supervisord"]
