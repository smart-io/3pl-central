import dotenv from 'dotenv';
import findOrders from './find-orders/server';
import Seneca from 'seneca';

dotenv.config();

const seneca = Seneca({ timeout: 99999 });

seneca.add({ role: '3pl-central', cmd: 'findOrders' }, function (msg, respond) {
  findOrders(msg.beginDate).then(orders => respond(null, orders));
});

seneca.listen();
