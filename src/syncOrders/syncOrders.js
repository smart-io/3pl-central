import moment from 'moment';
import { connect } from '../mongo';
import findOrders from '../findOrders/findOrders';
import { store } from '../app';
import * as ordersActions from '../orders/ordersActions';

function fetchLatestSync() {
  return null;
}

function fetchOneMonth(month = 0) {
  return new Promise((resolve, reject) => {
    const start = moment().subtract(month + 1, 'months');
    let end = moment().subtract(month, 'months').add(1, 'days');
    if (end.isAfter(moment())) {
      end = moment();
    }
    findOrders(start, end).then(resolve).catch(reject);
  });
}

function persistOrders(orders) {
  return new Promise((resolve, reject) => {
    connect().then(db => {
      const total = orders.length;
      let index = 0;
      db.collection('orders').createIndex({ WarehouseTransactionID: 1 }, { unique: true });
      orders.forEach(order => {
        db.collection('orders').updateOne(
          { WarehouseTransactionID : order.WarehouseTransactionID },
          { $set: { ...order } },
          { upsert: true },
          function(err, result) {
            if (err) throw err;
            index++;
            if (result.result.upserted) {
              store.dispatch(ordersActions.createOrder(order));
            } else if (result.result.nModified) {
              store.dispatch(ordersActions.updateOrder(order));
            }
            if (index === total) resolve();
          }
        );
      });
    }).catch(reject);
  });
}

export default function () {
  const latestSync = fetchLatestSync();
  if (!latestSync) {
    fetchOneMonth().then(orders => {
      if (orders.length) {
        persistOrders(orders);
      }
    }).catch();
  }
}
