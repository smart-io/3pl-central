import syncOrders from './syncOrders/syncOrders';

export default function (channel) {
  const orders$ = syncOrders();

  orders$
    .subscribe(result => {
      const order = result.order;
      if (result.insert) {
        channel.assertQueue('newOrder', { durable: true });
        channel.sendToQueue('newOrder', new Buffer(JSON.stringify(order)));
      }
      //if (result.update) console.log('update ' + order.WarehouseTransactionID);
    });
}
