import amqp from 'amqplib/callback_api';

function generateUuid() {
  return Math.random().toString() +
    Math.random().toString() +
    Math.random().toString();
}

class Client {
  connection;
  host;
  channel;
  pendingRequests = [];
  eventListeners = {};

  connect = host => {
    if (!host && process.env['3PL_CENTRAL_PORT']) {
      let config = process.env['3PL_CENTRAL_PORT'].match(/\/\/([^:]*):?(\d*)/);
      host = config[1];
    }
    this.host = host;
    return new Promise((resolve, reject) => {
      amqp.connect('amqp://' + this.host, (err, connection) => {
        if (err) return reject(err);
        this.connection = connection;
        this.connection.createChannel((err, channel) => {
          if (err) return reject(err);
          this.channel = channel;
          resolve(this);
        });
      });
    });
  };

  close = () => {
    this.connection.close();
  };

  request = (command, args) => {
    return new Promise((resolve, reject) => {
      if (!this.channel) {
        this.pendingRequests.push([command, args, resolve, reject]);
      } else {
        this.doRequest(command, args, resolve, reject);
      }
    });
  };

  doRequest(command, args, resolve, reject) {
    this.channel.assertQueue('', { exclusive: true }, (err, q) => {
      const corr = generateUuid();

      this.channel.consume(q.queue, function(msg) {
        if (msg.properties.correlationId == corr) {
          let content = JSON.parse(msg.content.toString());
          resolve(content);
        }
      }, { noAck: true });

      this.channel.sendToQueue(
        command,
        new Buffer(JSON.stringify(args)),
        { correlationId: corr, replyTo: q.queue }
      );
    });
  }

  listen = () => {
    const events = [
      'newOrder'
    ];
    for (let i = 0, len = events.length; i < len; ++i) {
      this.channel.assertQueue(events[i], { durable: true });
      this.channel.consume(events[i], msg => {
        this.channel.ack(msg);
        this.trigger(events[i], JSON.parse(msg.content.toString()))
      });
    }
  };

  on = (e, cb) => {
    if (!this.eventListeners[e]) this.eventListeners[e] = [];
    this.eventListeners[e].push(cb);
  };

  off = (e, cb) => {
    if (!cb) {
      this.eventListeners[e] = [];
    } else {
      let finalEventListeners = [];
      for (let i = 0, len = this.eventListeners[e].length; i < len; ++i) {
        if (this.eventListeners[e][i] !== cb) finalEventListeners.push(this.eventListeners[e][i]);
      }
      this.eventListeners[e] = finalEventListeners;
    }
  };

  trigger(e, data) {
    if (this.eventListeners[e]) {
      for (let i = 0, len = this.eventListeners[e].length; i < len; ++i) {
        this.eventListeners[e][i](data);
      }
    }
  }
}

export default Client;
