FROM node

RUN apt-get update
RUN apt-get install -y supervisor
RUN apt-get install -y git

RUN mkdir -p /var/log/supervisor

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

RUN git clone https://github.com/smart-io/3pl-central.git /usr/src/app
RUN cd /usr/src/app && npm install

EXPOSE 10101

CMD ["/usr/bin/supervisord"]
