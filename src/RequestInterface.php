<?php

namespace ThreePlCentral;

interface RequestInterface
{
    public function __construct(string $method, string $body);
    public function fetch(array $data): ResponseInterface;
    public function setTemplate(string $template);
    public function getId(): string;
    public function setId(string $id);
    public function getCustomerId(): string;
    public function setCustomerId(string $customerId);
    public function getFacilityId(): string;
    public function setFacilityId(string $facilityId);
    public function getLogin(): string;
    public function setLogin(string $login);
    public function getPassword(): string;
    public function setPassword(string $password);
}
