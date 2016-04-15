import client from './client';

export findOrders from './find-orders/client';

export function close() {
  let seneca = client();
  if (seneca) {
    seneca.close(function (err) {
      if (err) console.error('err: ' + err)
    });
  }
}
