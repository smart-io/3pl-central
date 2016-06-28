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

    public function toArray()
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

    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    }

    public function getCustomerEmail()
    {
        return $this->customerEmail;
    }

    public function setCustomerEmail($customerEmail)
    {
        $this->customerEmail = $customerEmail;
    }

    public function getCustomerPhone()
    {
        return $this->customerPhone;
    }

    public function setCustomerPhone($customerPhone)
    {
        $this->customerPhone = $customerPhone;
    }

    public function getFacility()
    {
        return $this->facility;
    }

    public function setFacility($facility)
    {
        $this->facility = $facility;
    }

    public function getFacilityID()
    {
        return $this->facilityID;
    }

    public function setFacilityID($facilityID)
    {
        $this->facilityID = $facilityID;
    }

    public function getWarehouseTransactionID()
    {
        return $this->warehouseTransactionID;
    }

    public function setWarehouseTransactionID($warehouseTransactionID)
    {
        $this->warehouseTransactionID = $warehouseTransactionID;
    }

    public function getReferenceNum()
    {
        return $this->referenceNum;
    }

    public function setReferenceNum($referenceNum)
    {
        $this->referenceNum = $referenceNum;
    }

    public function getPONum()
    {
        return $this->pONum;
    }

    public function setPONum($pONum)
    {
        $this->pONum = $pONum;
    }

    public function getRetailer()
    {
        return $this->retailer;
    }

    public function setRetailer($retailer)
    {
        $this->retailer = $retailer;
    }

    public function getShipToCompanyName()
    {
        return $this->shipToCompanyName;
    }

    public function setShipToCompanyName($shipToCompanyName)
    {
        $this->shipToCompanyName = $shipToCompanyName;
    }

    public function getShipToName()
    {
        return $this->shipToName;
    }

    public function setShipToName($shipToName)
    {
        $this->shipToName = $shipToName;
    }

    public function getShipToEmail()
    {
        return $this->shipToEmail;
    }

    public function setShipToEmail($shipToEmail)
    {
        $this->shipToEmail = $shipToEmail;
    }

    public function getShipToPhone()
    {
        return $this->shipToPhone;
    }

    public function setShipToPhone($shipToPhone)
    {
        $this->shipToPhone = $shipToPhone;
    }

    public function getShipToAddress1()
    {
        return $this->shipToAddress1;
    }

    public function setShipToAddress1($shipToAddress1)
    {
        $this->shipToAddress1 = $shipToAddress1;
    }

    public function getShipToAddress2()
    {
        return $this->shipToAddress2;
    }

    public function setShipToAddress2($shipToAddress2)
    {
        $this->shipToAddress2 = $shipToAddress2;
    }

    public function getShipToCity()
    {
        return $this->shipToCity;
    }

    public function setShipToCity($shipToCity)
    {
        $this->shipToCity = $shipToCity;
    }

    public function getShipToState()
    {
        return $this->shipToState;
    }

    public function setShipToState($shipToState)
    {
        $this->shipToState = $shipToState;
    }

    public function getShipToZip()
    {
        return $this->shipToZip;
    }

    public function setShipToZip($shipToZip)
    {
        $this->shipToZip = $shipToZip;
    }

    public function getShipToCountry()
    {
        return $this->shipToCountry;
    }

    public function setShipToCountry($shipToCountry)
    {
        $this->shipToCountry = $shipToCountry;
    }

    public function getShipMethod()
    {
        return $this->shipMethod;
    }

    public function setShipMethod($shipMethod)
    {
        $this->shipMethod = $shipMethod;
    }

    public function getMarkForName()
    {
        return $this->markForName;
    }

    public function setMarkForName($markForName)
    {
        $this->markForName = $markForName;
    }

    public function getBatchOrderID()
    {
        return $this->batchOrderID;
    }

    public function setBatchOrderID($batchOrderID)
    {
        $this->batchOrderID = $batchOrderID;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    public function getEarliestShipDate()
    {
        return $this->earliestShipDate;
    }

    public function setEarliestShipDate($earliestShipDate)
    {
        $this->earliestShipDate = $earliestShipDate;
    }

    public function getShipCancelDate()
    {
        return $this->shipCancelDate;
    }

    public function setShipCancelDate($shipCancelDate)
    {
        $this->shipCancelDate = $shipCancelDate;
    }

    public function getPickupDate()
    {
        return $this->pickupDate;
    }

    public function setPickupDate($pickupDate)
    {
        $this->pickupDate = $pickupDate;
    }

    public function getCarrier()
    {
        return $this->carrier;
    }

    public function setCarrier($carrier)
    {
        $this->carrier = $carrier;
    }

    public function getBillingCode()
    {
        return $this->billingCode;
    }

    public function setBillingCode($billingCode)
    {
        $this->billingCode = $billingCode;
    }

    public function getTotWeight()
    {
        return $this->totWeight;
    }

    public function setTotWeight($totWeight)
    {
        $this->totWeight = $totWeight;
    }

    public function getTotCuFt()
    {
        return $this->totCuFt;
    }

    public function setTotCuFt($totCuFt)
    {
        $this->totCuFt = $totCuFt;
    }

    public function getTotPackages()
    {
        return $this->totPackages;
    }

    public function setTotPackages($totPackages)
    {
        $this->totPackages = $totPackages;
    }

    public function getTotOrdQty()
    {
        return $this->totOrdQty;
    }

    public function setTotOrdQty($totOrdQty)
    {
        $this->totOrdQty = $totOrdQty;
    }

    public function getTotLines()
    {
        return $this->totLines;
    }

    public function setTotLines($totLines)
    {
        $this->totLines = $totLines;
    }

    public function getNotes()
    {
        return $this->notes;
    }

    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    public function getOverAllocated()
    {
        return $this->overAllocated;
    }

    public function setOverAllocated($overAllocated)
    {
        $this->overAllocated = $overAllocated;
    }

    public function getPickTicketPrintDate()
    {
        return $this->pickTicketPrintDate;
    }

    public function setPickTicketPrintDate($pickTicketPrintDate)
    {
        $this->pickTicketPrintDate = $pickTicketPrintDate;
    }

    public function getProcessDate()
    {
        return $this->processDate;
    }

    public function setProcessDate($processDate)
    {
        $this->processDate = $processDate;
    }

    public function getTrackingNumber()
    {
        return $this->trackingNumber;
    }

    public function setTrackingNumber($trackingNumber)
    {
        $this->trackingNumber = $trackingNumber;
    }

    public function getLoadNumber()
    {
        return $this->loadNumber;
    }

    public function setLoadNumber($loadNumber)
    {
        $this->loadNumber = $loadNumber;
    }

    public function getBillOfLading()
    {
        return $this->billOfLading;
    }

    public function setBillOfLading($billOfLading)
    {
        $this->billOfLading = $billOfLading;
    }

    public function getMasterBillOfLading()
    {
        return $this->masterBillOfLading;
    }

    public function setMasterBillOfLading($masterBillOfLading)
    {
        $this->masterBillOfLading = $masterBillOfLading;
    }

    public function getASNSentDate()
    {
        return $this->aSNSentDate;
    }

    public function setASNSentDate($aSNSentDate)
    {
        $this->aSNSentDate = $aSNSentDate;
    }

    public function getConfirmASNSentDate()
    {
        return $this->confirmASNSentDate;
    }

    public function setConfirmASNSentDate($confirmASNSentDate)
    {
        $this->confirmASNSentDate = $confirmASNSentDate;
    }

    public function getRememberRowInfo()
    {
        return $this->rememberRowInfo;
    }

    public function setRememberRowInfo($rememberRowInfo)
    {
        $this->rememberRowInfo = $rememberRowInfo;
    }
}
