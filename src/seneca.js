import { findOrders } from '../index';
import Seneca from 'seneca';

const seneca = Seneca({ timeout: 99999 });

seneca.add({ role: '3pl-central', cmd: 'findOrders' }, function (msg, respond) {
  findOrders(msg.beginDate).then(orders => respond(null, orders));
});

seneca.listen();
