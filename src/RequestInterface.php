<?php

namespace ThreePlCentral;

interface RequestInterface
{
    public function __construct($method, $body);
    public function fetch(array $data);
    public function setTemplate($template);
    public function getId();
    public function setId($id);
    public function getCustomerId();
    public function setCustomerId($customerId);
    public function getFacilityId();
    public function setFacilityId($facilityId);
    public function getLogin();
    public function setLogin($login);
    public function getPassword();
    public function setPassword($password);
}
