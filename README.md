# 3PL Central

## Microservice

Config in `.env` file.

```
docker pull smartio/3pl-central
docker run -p 10101:10101 -it --rm --name 3pl-central -v \"$PWD\":/usr/src/app -w /usr/src/app smartio/3pl-central 
```

## Usage

```js
import tpl from '3pl-central';
import moment from 'moment';

tpl.findOrders(moment().subtract(30, 'days'))
  .then(res => console.log(res);
```
