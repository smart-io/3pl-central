# ![PHP 3PL Central](https://rawgit.com/smart-io/php-3pl-central/master/php-3pl-central-logo.svg "PHP 3PL Central")

[![Build Status](https://travis-ci.org/smart-io/php-3pl-central.svg?branch=master)](https://travis-ci.org/smart-io/php-3pl-central)
[![StyleCI](https://styleci.io/repos/53067404/shield)](https://styleci.io/repos/53067404)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/smart-io/php-3pl-central/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/smart-io/php-3pl-central/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/smart-io/php-3pl-central/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/smart-io/php-3pl-central/?branch=master)
[![Code Climate](https://codeclimate.com/github/smart-io/php-3pl-central/badges/gpa.svg)](https://codeclimate.com/github/smart-io/php-3pl-central)
[![Latest Stable Version](http://img.shields.io/packagist/v/smart/3pl-central.svg?style=flat)](https://packagist.org/packages/smart/3pl-central)
[![Total Downloads](https://img.shields.io/packagist/dt/smart/3pl-central.svg?style=flat)](https://packagist.org/packages/smart/3pl-central)
[![License](https://img.shields.io/packagist/l/smart/3pl-central.svg?style=flat)](https://packagist.org/packages/smart/3pl-central)
[![SensioLabsInsight](https://insight.sensiolabs.com/projects/22e29343-ee01-4cd1-8796-c19152c3c195/mini.png)](https://insight.sensiolabs.com/projects/22e29343-ee01-4cd1-8796-c19152c3c195)
[![Join the chat at https://gitter.im/smart-io/php-3pl-central](https://badges.gitter.im/smart-io/php-3pl-central.svg)](https://gitter.im/smart-io/php-3pl-central?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)

This library is aimed at wrapping the 3PL Central API into a simple to use PHP Library. Feel free to contribute.

## Table Of Content

1. [Requirements](#requirements)
2. [Installation](#installation)
3. [Find Orders](#find-orders)
    * [Example](#find-orders-example)
    * [Parameters](#find-orders-parameters)
4. [License](#license)

<a name="requirements"></a>
## Requirements

This library uses PHP 7.0+.

To use the 3PL Central, you have to [obtain credentials from 3PL Central](http://3plcentral.com/support/). For every request,
you will have to provide the ID, Customer ID, Facility ID and your 3PL Central Login and Password.

<a name="installation"></a>
## Installation

It is recommended that you install the PHP 3PL Central library [through composer](http://getcomposer.org/). To do so,
run the Composer command to install the latest stable version of PHP 3PL Central:

```shell
composer require smart/3pl-central
```

<a name="find-orders"></a>
## Find Orders

<a name="find-orders-example"></a>
### Example

```php
use ThreePlCentral\ThreePlCentral;

$threepl = new ThreePlCentral($id, $customerId, $facilityId, $login, $password);
$threepl->findOrders((new DateTime())->modify('-30 days'), new DateTime());
```

<a name="find-orders-parameters"></a>
### Parameters

Find Orders parameters are:

 * `beginDate` __Object(DateTime)__ Beginning date time for the retrieval criteria of the orders.
 * `endDate` __Object(DateTime)__ Ending date time for the retrieval criteria of the orders.

### Fields

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

<a name="license"></a>
## License

PHP 3PL Central is licensed under The MIT License (MIT).
