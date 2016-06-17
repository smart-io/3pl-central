import moment from 'moment';
import { connect } from '../mongo';
import findOrders from '../findOrders/findOrders';
import Rx from 'rxjs/Rx';

function fetchLatestSync() {
  return new Promise((resolve, reject) => {
    connect().then(db => {
      db.collection('orders').find().sort({ CreationDate: -1 }).limit(1).toArray((err, result) => {
        if (err) reject(err);
        else if (!result[0]) reject();
        else resolve(moment(result[0].CreationDate).subtract(1, 'days'));
      })
    }).catch(err => reject(err));
  });
}

function fetchAllOrders(prevObserver) {
  return new Rx.Observable.create(observer => {
    const pushToStream = function (orders) {
      orders.forEach(order => observer.next(order));
    };

    fetchLatestSync()
      .then(latestSync => {
        findOrders(latestSync, moment()).then(orders => {
          pushToStream(orders);
        }).catch(err => prevObserver.error(err));
      })
      .catch(() => {
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
          }).catch(err => prevObserver.error(err));
        };
        fetch();
      });
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
        if (err) observer.error(err);
        else if (result.result.upserted) observer.next({ insert: true, order });
        else if (result.result.nModified) observer.next({ update: true, order });
      }
    );
  }).catch(err => observer.error(err));
}

export default function () {
  return Rx.Observable.create(observer => {
    const fetch = () => {
      fetchAllOrders(observer).subscribe(order => {
        persistOrder(order, observer);
      });
    };

    fetch();
    const interval = setInterval(fetch, 1000 * 60);

    return () => {
      clearInterval(interval);
    };
  });
}
