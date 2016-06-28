<?php

namespace ThreePlCentral\Order;

class OrderEntity
{
    private $customerName;
    private $customerEmail;
    private $customerPhone;
    private $facility;
    private $facilityID;
    private $warehouseTransactionID;
    private $referenceNum;
    private $pONum;
    private $retailer;
    private $shipToCompanyName;
    private $shipToName;
    private $shipToEmail;
    private $shipToPhone;
    private $shipToAddress1;
    private $shipToAddress2;
    private $shipToCity;
    private $shipToState;
    private $shipToZip;
    private $shipToCountry;
    private $shipMethod;
    private $markForName;
    private $batchOrderID;
    private $creationDate;
    private $earliestShipDate;
    private $shipCancelDate;
    private $pickupDate;
    private $carrier;
    private $billingCode;
    private $totWeight;
    private $totCuFt;
    private $totPackages;
    private $totOrdQty;
    private $totLines;
    private $notes;
    private $overAllocated;
    private $pickTicketPrintDate;
    private $processDate;
    private $trackingNumber;
    private $loadNumber;
    private $billOfLading;
    private $masterBillOfLading;
    private $aSNSentDate;
    private $confirmASNSentDate;
    private $rememberRowInfo;

    public function toArray(): array
    {
        return [
            'customerName' => $this->customerName,
            'customerEmail' => $this->customerEmail,
            'customerPhone' => $this->customerPhone,
            'facility' => $this->facility,
            'facilityID' => $this->facilityID,
            'warehouseTransactionID' => $this->warehouseTransactionID,
            'referenceNum' => $this->referenceNum,
            'pONum' => $this->pONum,
            'retailer' => $this->retailer,
            'shipToCompanyName' => $this->shipToCompanyName,
            'shipToName' => $this->shipToName,
            'shipToEmail' => $this->shipToEmail,
            'shipToPhone' => $this->shipToPhone,
            'shipToAddress1' => $this->shipToAddress1,
            'shipToAddress2' => $this->shipToAddress2,
            'shipToCity' => $this->shipToCity,
            'shipToState' => $this->shipToState,
            'shipToZip' => $this->shipToZip,
            'shipToCountry' => $this->shipToCountry,
            'shipMethod' => $this->shipMethod,
            'markForName' => $this->markForName,
            'batchOrderID' => $this->batchOrderID,
            'creationDate' => $this->creationDate,
            'earliestShipDate' => $this->earliestShipDate,
            'shipCancelDate' => $this->shipCancelDate,
            'pickupDate' => $this->pickupDate,
            'carrier' => $this->carrier,
            'billingCode' => $this->billingCode,
            'totWeight' => $this->totWeight,
            'totCuFt' => $this->totCuFt,
            'totPackages' => $this->totPackages,
            'totOrdQty' => $this->totOrdQty,
            'totLines' => $this->totLines,
            'notes' => $this->notes,
            'overAllocated' => $this->overAllocated,
            'pickTicketPrintDate' => $this->pickTicketPrintDate,
            'processDate' => $this->processDate,
            'trackingNumber' => $this->trackingNumber,
            'loadNumber' => $this->loadNumber,
            'billOfLading' => $this->billOfLading,
            'masterBillOfLading' => $this->masterBillOfLading,
            'aSNSentDate' => $this->aSNSentDate,
            'confirmASNSentDate' => $this->confirmASNSentDate,
            'rememberRowInfo' => $this->rememberRowInfo
        ];
    }

    public function getCustomerName()
    {
        return $this->customerName;
    }

    public function setCustomerName(string $customerName)
    {
        $this->customerName = $customerName;
    }

    public function getCustomerEmail()
    {
        return $this->customerEmail;
    }

    public function setCustomerEmail(string $customerEmail)
    {
        $this->customerEmail = $customerEmail;
    }

    public function getCustomerPhone()
    {
        return $this->customerPhone;
    }

    public function setCustomerPhone(string $customerPhone)
    {
        $this->customerPhone = $customerPhone;
    }

    public function getFacility()
    {
        return $this->facility;
    }

    public function setFacility(string $facility)
    {
        $this->facility = $facility;
    }

    public function getFacilityID()
    {
        return $this->facilityID;
    }

    public function setFacilityID(string $facilityID)
    {
        $this->facilityID = $facilityID;
    }

    public function getWarehouseTransactionID()
    {
        return $this->warehouseTransactionID;
    }

    public function setWarehouseTransactionID(string $warehouseTransactionID)
    {
        $this->warehouseTransactionID = $warehouseTransactionID;
    }

    public function getReferenceNum()
    {
        return $this->referenceNum;
    }

    public function setReferenceNum(string $referenceNum)
    {
        $this->referenceNum = $referenceNum;
    }

    public function getPONum()
    {
        return $this->pONum;
    }

    public function setPONum(string $pONum)
    {
        $this->pONum = $pONum;
    }

    public function getRetailer()
    {
        return $this->retailer;
    }

    public function setRetailer(string $retailer)
    {
        $this->retailer = $retailer;
    }

    public function getShipToCompanyName()
    {
        return $this->shipToCompanyName;
    }

    public function setShipToCompanyName(string $shipToCompanyName)
    {
        $this->shipToCompanyName = $shipToCompanyName;
    }

    public function getShipToName()
    {
        return $this->shipToName;
    }

    public function setShipToName(string $shipToName)
    {
        $this->shipToName = $shipToName;
    }

    public function getShipToEmail()
    {
        return $this->shipToEmail;
    }

    public function setShipToEmail(string $shipToEmail)
    {
        $this->shipToEmail = $shipToEmail;
    }

    public function getShipToPhone()
    {
        return $this->shipToPhone;
    }

    public function setShipToPhone(string $shipToPhone)
    {
        $this->shipToPhone = $shipToPhone;
    }

    public function getShipToAddress1()
    {
        return $this->shipToAddress1;
    }

    public function setShipToAddress1(string $shipToAddress1)
    {
        $this->shipToAddress1 = $shipToAddress1;
    }

    public function getShipToAddress2()
    {
        return $this->shipToAddress2;
    }

    public function setShipToAddress2(string $shipToAddress2)
    {
        $this->shipToAddress2 = $shipToAddress2;
    }

    public function getShipToCity()
    {
        return $this->shipToCity;
    }

    public function setShipToCity(string $shipToCity)
    {
        $this->shipToCity = $shipToCity;
    }

    public function getShipToState()
    {
        return $this->shipToState;
    }

    public function setShipToState(string $shipToState)
    {
        $this->shipToState = $shipToState;
    }

    public function getShipToZip()
    {
        return $this->shipToZip;
    }

    public function setShipToZip(string $shipToZip)
    {
        $this->shipToZip = $shipToZip;
    }

    public function getShipToCountry()
    {
        return $this->shipToCountry;
    }

    public function setShipToCountry(string $shipToCountry)
    {
        $this->shipToCountry = $shipToCountry;
    }

    public function getShipMethod()
    {
        return $this->shipMethod;
    }

    public function setShipMethod(string $shipMethod)
    {
        $this->shipMethod = $shipMethod;
    }

    public function getMarkForName()
    {
        return $this->markForName;
    }

    public function setMarkForName(string $markForName)
    {
        $this->markForName = $markForName;
    }

    public function getBatchOrderID()
    {
        return $this->batchOrderID;
    }

    public function setBatchOrderID(string $batchOrderID)
    {
        $this->batchOrderID = $batchOrderID;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate(string $creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function getEarliestShipDate()
    {
        return $this->earliestShipDate;
    }

    public function setEarliestShipDate(string $earliestShipDate)
    {
        $this->earliestShipDate = $earliestShipDate;
    }

    public function getShipCancelDate()
    {
        return $this->shipCancelDate;
    }

    public function setShipCancelDate(string $shipCancelDate)
    {
        $this->shipCancelDate = $shipCancelDate;
    }

    public function getPickupDate()
    {
        return $this->pickupDate;
    }

    public function setPickupDate(string $pickupDate)
    {
        $this->pickupDate = $pickupDate;
    }

    public function getCarrier()
    {
        return $this->carrier;
    }

    public function setCarrier(string $carrier)
    {
        $this->carrier = $carrier;
    }

    public function getBillingCode()
    {
        return $this->billingCode;
    }

    public function setBillingCode(string $billingCode)
    {
        $this->billingCode = $billingCode;
    }

    public function getTotWeight()
    {
        return $this->totWeight;
    }

    public function setTotWeight(string $totWeight)
    {
        $this->totWeight = $totWeight;
    }

    public function getTotCuFt()
    {
        return $this->totCuFt;
    }

    public function setTotCuFt(string $totCuFt)
    {
        $this->totCuFt = $totCuFt;
    }

    public function getTotPackages()
    {
        return $this->totPackages;
    }

    public function setTotPackages(string $totPackages)
    {
        $this->totPackages = $totPackages;
    }

    public function getTotOrdQty()
    {
        return $this->totOrdQty;
    }

    public function setTotOrdQty(string $totOrdQty)
    {
        $this->totOrdQty = $totOrdQty;
    }

    public function getTotLines()
    {
        return $this->totLines;
    }

    public function setTotLines(string $totLines)
    {
        $this->totLines = $totLines;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function setNotes(string $notes)
    {
        $this->notes = $notes;
    }

    public function getOverAllocated()
    {
        return $this->overAllocated;
    }

    public function setOverAllocated(string $overAllocated)
    {
        $this->overAllocated = $overAllocated;
    }

    public function getPickTicketPrintDate()
    {
        return $this->pickTicketPrintDate;
    }

    public function setPickTicketPrintDate(string $pickTicketPrintDate)
    {
        $this->pickTicketPrintDate = $pickTicketPrintDate;
    }

    public function getProcessDate()
    {
        return $this->processDate;
    }

    public function setProcessDate(string $processDate)
    {
        $this->processDate = $processDate;
    }

    public function getTrackingNumber()
    {
        return $this->trackingNumber;
    }

    public function setTrackingNumber(string $trackingNumber)
    {
        $this->trackingNumber = $trackingNumber;
    }

    public function getLoadNumber()
    {
        return $this->loadNumber;
    }

    public function setLoadNumber(string $loadNumber)
    {
        $this->loadNumber = $loadNumber;
    }

    public function getBillOfLading()
    {
        return $this->billOfLading;
    }

    public function setBillOfLading(string $billOfLading)
    {
        $this->billOfLading = $billOfLading;
    }

    public function getMasterBillOfLading()
    {
        return $this->masterBillOfLading;
    }

    public function setMasterBillOfLading(string $masterBillOfLading)
    {
        $this->masterBillOfLading = $masterBillOfLading;
    }

    public function getASNSentDate()
    {
        return $this->aSNSentDate;
    }

    public function setASNSentDate(string $aSNSentDate)
    {
        $this->aSNSentDate = $aSNSentDate;
    }

    public function getConfirmASNSentDate()
    {
        return $this->confirmASNSentDate;
    }

    public function setConfirmASNSentDate(string $confirmASNSentDate)
    {
        $this->confirmASNSentDate = $confirmASNSentDate;
    }

    public function getRememberRowInfo()
    {
        return $this->rememberRowInfo;
    }

    public function setRememberRowInfo(string $rememberRowInfo)
    {
        $this->rememberRowInfo = $rememberRowInfo;
    }
}
