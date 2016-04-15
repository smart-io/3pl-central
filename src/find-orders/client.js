import client from '../client';

export default function (beginDate) {
  return new Promise((resolve, reject) => {
    const seneca = client();

    seneca.act({ role: '3pl-central', cmd: 'findOrders', beginDate: beginDate }, function (err, res) {
      if (err) reject(err);
      else resolve(res);
    });
  });
};
