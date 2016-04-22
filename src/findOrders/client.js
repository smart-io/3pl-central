import { client } from '../index';

export default function (beginDate, endDate) {
  return new Promise((resolve, reject) => {
    client.request('findOrders', { beginDate, endDate }).then(resolve).catch(reject);
  });
};
