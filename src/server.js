import dotenv from 'dotenv';
import amqp from 'amqplib/callback_api';
import tasks from './tasks';
import findOrders from './findOrders/findOrders';

dotenv.config();

class Server {
  static requests = [
    'findOrders'
  ];

  connection;

  listen() {
    amqp.connect('amqp://localhost', (err, conn) => {
      if (err) throw err;
      this.connection = conn;
      this.connection.createChannel((err, ch) => {
        for (let i = 0, len = Server.requests.length; i < len; ++i) {
          ch.assertQueue(Server.requests[i], { durable: false });
          ch.consume(Server.requests[i], msg => this.handleRequest(ch, Server.requests[i], msg));
        }
        tasks();
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
