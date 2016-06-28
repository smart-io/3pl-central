<?php

namespace ThreePlCentral;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7;

class Request implements RequestInterface
{
    private $id;
    private $customerId;
    private $facilityId;
    private $login;
    private $password;
    private $method;
    private $url;
    private $template;

    public function __construct(string $method, string $url)
    {
        $this->method = $method;
        $this->url = $url;
    }

    public function fetch(array $data): ResponseInterface
    {
        $client = new Client();
        $request = new Psr7\Request(
            $this->method,
            'https://secure-wms.com/webserviceexternal/contracts.asmx',
            [
                'SOAPAction' => $this->url,
                'Content-Type' => 'text/xml; charset=utf-8'
            ],
            $this->getBody($data)
        );

        try {
            $reponse = $client->send($request);
        } catch (\Exception $error) {
            $response = new Response($error->getResponse());
            throw new Exception($response->json()['error'], $error->getCode(), $error);
        }
        
        return new Response($reponse);
    }

    private function getBody(array $data): string
    {
        $content = file_get_contents($this->template);

        $data = array_merge($data, [
          'ThreePLID' => $this->getId(),
          'Login' => $this->getLogin(),
          'Password' => $this->getPassword(),
          'CustomerID' => $this->getCustomerId(),
          'FacilityID' => $this->getFacilityId()
        ]);

        foreach ($data as $prop => $value) {
            $content = str_replace("{{$prop}}", $value, $content);
        }

        return $content;
    }

    public function setTemplate(string $template)
    {
        $this->template = $template;
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

    public function getUrl(): string
    {
        return $this->url;
    }
}
