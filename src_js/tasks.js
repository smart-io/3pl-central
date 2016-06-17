import syncOrders from './syncOrders/syncOrders';

export default function () {
  setInterval(syncOrders, 1000 * 60);
}
