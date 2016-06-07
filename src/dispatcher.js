import syncOrders from './syncOrders/syncOrders';
import log from './log';

export default function (channel) {
  const orders$ = syncOrders();

  orders$
    .subscribe(result => {
      const order = result.order;
      if (result.insert) {
        log.info('New order: %s', order.WarehouseTransactionID);
        channel.assertQueue('newOrder', { durable: true });
        channel.sendToQueue('newOrder', new Buffer(JSON.stringify(order)));
      }
    });
}
