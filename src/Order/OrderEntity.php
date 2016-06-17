<?php
namespace ThreePlCentral\Order;

/**
 * @Entity
 * @Table(name="orders")
 */
class OrderEntity
{
    /** @Id @Column(type="integer") @GeneratedValue */
    private $id;
}

/*CustomerName
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
*/