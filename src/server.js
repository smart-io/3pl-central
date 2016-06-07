import dotenv from 'dotenv';
import amqp from 'amqplib/callback_api';
import tasks from './tasks';
import findOrders from './findOrders/findOrders';
import dispatcher from './dispatcher';
import log from './log';

dotenv.config();

class Server {
  static requests = [
    'findOrders'
  ];

  connection;

  listen() {
    amqp.connect('amqp://localhost', (err, connection) => {
      if (err) {
        log.error('AMQP error: %s', err.message);
        return process.exit(1);
      }
      this.connection = connection;

      this.connection.on('error', err => {
        log.error('AMQP error: %s', err.message);
        this.connection = null;
        process.exit(1);
      });

      this.connection.on('close', () => {
        log.error('AMQP connection closed');
        this.connection = null;
        process.exit(1);
      });

      this.connection.createChannel((err, ch) => {
        log.info('AMQP connection open');
        for (let i = 0, len = Server.requests.length; i < len; ++i) {
          ch.assertQueue(Server.requests[i], { durable: true });
          ch.consume(Server.requests[i], msg => this.handleRequest(ch, Server.requests[i], msg));
        }

        tasks();
        dispatcher(ch);
      });
    });
  }

  handleRequest = (channel, command, msg) => {
    this.doHandleRequest(command, JSON.parse(msg.content.toString()))
      .then(response => {
        channel.sendToQueue(
          msg.properties.replyTo,
          new Buffer(JSON.stringify(response)),
          { correlationId: msg.properties.correlationId }
        );
        channel.ack(msg);
      })
      .catch(err => {
        channel.sendToQueue(
          msg.properties.replyTo,
          new Buffer(JSON.stringify(err)),
          { correlationId: msg.properties.correlationId }
        );
        channel.reject(msg, true);
      });
  };

  doHandleRequest(command, args) {
    return new Promise((resolve, reject) => {
      switch(command) {
      case 'findOrders': findOrders(args.beginDate, args.endDate).then(resolve).catch(reject); break;
      }
    });
  }
}

const server = new Server();
server.listen();
