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

    public function __construct(string $id, string $customerId, string $facilityId, string $login, string $password) {
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

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id)
    {
        $this->id = $id;
    }

    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    public function setCustomerId(string $customerId)
    {
        $this->customerId = $customerId;
    }

    public function getFacilityId(): string
    {
        return $this->facilityId;
    }

    public function setFacilityId(string $facilityId)
    {
        $this->facilityId = $facilityId;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function setLogin(string $login)
    {
        $this->login = $login;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }
}
