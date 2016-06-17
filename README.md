# 3PL Central

## Microservice

Config in `.env` file.

```
docker pull smartio/3pl-central
docker run -p 80:80 it --rm --name 3pl-central smartio/3pl-central 
```

## Docker Compose

```yaml
3pl-central:
  env_file: .env
  image: smartio/3pl-central
  volumes:
   - "/mnt/sda1/var/3pl_central_data:/var/lib/mysql"
  ports:
    - "80:80"
```

## Usage

### Listen to new orders
 
```js
import { connect, listen } from '3pl-central';

connect(host)
  .then(client => {
    client.on('newOrder', order => console.log(order));
  })
  .then(listen);
```

### Find orders
 
```js
import { connect, close, findOrders } from '3pl-central';
import moment from 'moment';

connect(host)
  .then(() => findOrders(moment().subtract(14, 'days')))
  .then(orders => console.log(orders))
  .then(close);
```

### Data Structure

#### Order

```
CustomerName
CustomerEmail
CustomerPhone
Facility
FacilityID
WarehouseTransactionID
ReferenceNum
PONum
Retailer
ShipToCompanyName
ShipToName
ShipToEmail
ShipToPhone
ShipToAddress1
ShipToAddress2
ShipToCity
ShipToState
ShipToZip
ShipToCountry
ShipMethod
MarkForName
BatchOrderID
CreationDate
EarliestShipDate
ShipCancelDate
PickupDate
Carrier
BillingCode
TotWeight
TotCuFt
TotPackages
TotOrdQty
TotLines
Notes
OverAllocated
PickTicketPrintDate
ProcessDate
TrackingNumber
LoadNumber
BillOfLading
MasterBillOfLading
ASNSentDate
ConfirmASNSentDate
RememberRowInfo
```
