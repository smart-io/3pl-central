import moment from 'moment';
import { connect, close } from '../mongo';
import findOrders from '../findOrders/findOrders';
import { store } from '../app';
import * as ordersActions from '../orders/ordersActions';
import Rx from 'rxjs/Rx';
import 'rxjs/Rx';

function fetchLatestSync() {
  return null;
}

function fetchAllOrders() {
  return new Rx.Observable.create(observer => {
    const latestSync = fetchLatestSync();

    const pushToStream = function (orders) {
      orders.forEach(order => observer.next(order));
    };

    if (!latestSync) {
      let currentMonth = 0;
      let nextOrders = [];
      const fetch = function () {
        fetchOneMonth(currentMonth).then(orders => {
          if (orders && orders.length) {
            currentMonth++;
            nextOrders = [ ...orders, ...nextOrders ];
            fetch();
          } else {
            let finalOrders = {};
            for (let i = 0, len = nextOrders.length; i < len; ++i) {
              finalOrders[nextOrders[i].WarehouseTransactionID] = nextOrders[i];
            }
            nextOrders = finalOrders;
            finalOrders = [];
            for (let prop in nextOrders) {
              if (nextOrders.hasOwnProperty(prop)) finalOrders.push(nextOrders[prop]);
            }
            pushToStream(finalOrders);
          }
        }).catch(err => console.error(err));
      };
      fetch();
    }
  });
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

function persistOrder(order, observer) {
  connect().then(db => {
    db.collection('orders').createIndex({ WarehouseTransactionID: 1 }, { unique: true });
    db.collection('orders').updateOne(
      { WarehouseTransactionID : order.WarehouseTransactionID },
      { $set: { ...order } },
      { upsert: true },
      function(err, result) {
        if (err) throw err;
        if (result.result.upserted) observer.next({ insert: true, order });
        else if (result.result.nModified) observer.next({ update: true, order });
      }
    );
  }).catch(err => { throw err });
}

export default function () {
  return Rx.Observable.create(observer => {
    const fetch = () => {
      fetchAllOrders().subscribe(order => {
        persistOrder(order, observer);
      });
    };

    const timeout = setTimeout(fetch, 100);
    const interval = setInterval(fetch, 1000 * 60);

    return () => {
      clearTimeout(timeout);
      clearInterval(interval);
    };
  });
}
