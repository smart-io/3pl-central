import amqp from 'amqplib/callback_api';

class Client {
  connection;
  host;
  eventListeners = {};

  connect(host) {
    this.host = host;
  }

  close() {
    if (this.connection) {
      this.connection.close();
      this.connection = null;
    }
  }

  listen() {
    amqp.connect('amqp://' + this.host, function(err, conn) {
      if (err) throw err;
      this.connection = conn;
      this.connection.createChannel(function(err, ch) {
        const events = [
          'new-order'
        ];
        for (let i = 0, len = events.length; i < len; ++i) {
          ch.assertQueue(events[i], { durable: false });
          ch.consume(events[i], msg => this.trigger(events[i], msg.content.toJSON()), { noAck: true });
        }
      });
    });
  }

  on(e, cb) {
    if (!this.eventListeners[e]) this.eventListeners[e] = [];
    this.eventListeners[e].push(cb);
  }

  off(e, cb) {
    if (!cb) {
      this.eventListeners[e] = [];
    } else {
      let finalEventListeners = [];
      for (let i = 0, len = this.eventListeners[e].length; i < len; ++i) {
        if (this.eventListeners[e][i] !== cb) finalEventListeners.push(this.eventListeners[e][i]);
      }
      this.eventListeners[e] = finalEventListeners;
    }
  }

  trigger(e, data) {
    if (this.eventListeners[e]) {
      for (let i = 0, len = this.eventListeners[e].length; i < len; ++i) {
        this.eventListeners[e][i](data);
      }
    }
  }
}

export default Client;
