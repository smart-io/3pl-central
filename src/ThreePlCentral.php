<?php

namespace ThreePlCentral;

use DateTime;
use ThreePlCentral\Order\OrderRepository;

class ThreePlCentral
{
    private $id;
    private $customerId;
    private $facilityId;
    private $login;
    private $password;

    public function __construct($id, $customerId, $facilityId, $login, $password)
    {
        $this->id = $id;
        $this->customerId = $customerId;
        $this->facilityId = $facilityId;
        $this->login = $login;
        $this->password = $password;
    }

    public function findOrders(DateTime $beginDate, DateTime $endDate): array
    {
        return OrderRepository::findOrders($this, $beginDate, $endDate);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getCustomerId()
    {
        return $this->customerId;
    }

    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    public function getFacilityId()
    {
        return $this->facilityId;
    }

    public function setFacilityId($facilityId)
    {
        $this->facilityId = $facilityId;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }
}
