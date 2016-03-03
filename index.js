import moment from 'moment';
import findOrders from './src/find-orders/find-orders';
import dotenv from 'dotenv';

dotenv.config();

findOrders(moment().subtract(30, 'days'))
  .then((orders) => {
    console.log(orders.length);
  });
