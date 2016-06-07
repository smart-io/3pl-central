FROM ubuntu:latest

RUN apt-get update && apt-get install -y --force-yes git curl

# Install mongo
RUN apt-key adv --keyserver hkp://keyserver.ubuntu.com:80 --recv EA312927
RUN echo "deb http://repo.mongodb.org/apt/ubuntu "$(lsb_release -sc)"/mongodb-org/3.2 multiverse" | tee /etc/apt/sources.list.d/mongodb-org-3.2.list
RUN apt-get update && apt-get install -y --force-yes mongodb-org
RUN mkdir -p /data/db

# Install RabbitMQ
RUN apt-key adv --keyserver ha.pool.sks-keyservers.net --recv-keys F78372A06FF50C80464FC1B4F7B8CEA6056E8E56
RUN echo 'deb http://www.rabbitmq.com/debian testing main' > /etc/apt/sources.list.d/rabbitmq.list
RUN apt-get update && apt-get install -y --force-yes rabbitmq-server
COPY config/rabbitmq.config /etc/rabbitmq/rabbitmq.config
# DEV RUN rabbitmq-plugins enable rabbitmq_management

# Install nodejs
RUN curl -sL https://deb.nodesource.com/setup_5.x | sudo -E bash -
RUN apt-get install -y --force-yes nodejs

# Install supervisor
RUN apt-get install -y --force-yes supervisor
RUN mkdir -p /var/log/supervisor
COPY config/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Install project
RUN git clone https://github.com/smart-io/3pl-central.git /usr/src/app
RUN cd /usr/src/app && npm install --ignore-scripts

EXPOSE 4369 5671 5672 25672
# DEV EXPOSE 27017 15672

CMD ["/usr/bin/supervisord"]
