# 3PL Central

## Microservice

Config in `.env` file.

```
docker pull smartio/3pl-central
docker run -p 4369:4369 -p 5671:5671 -p 5672:5672 -p 25672:25672 it --rm --name 3pl-central smartio/3pl-central 
```

## Usage

### Listen to new orders
 
```js
import { connect, listen, close, findOrders } from './src/index';
import moment from 'moment';

connect(host)
  .then(client => {
    client.on('newOrder', order => console.log(order));
  })
  .then(listen);
```

### Find orders
 
```js
import { connect, listen, close, findOrders } from './src/index';
import moment from 'moment';

connect(host)
  .then(() => findOrders(moment().subtract(14, 'days')))
  .then(orders => console.log(orders))
  .then(close);
```
