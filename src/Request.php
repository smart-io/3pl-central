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

    public function __construct($method, $url)
    {
        $this->method = $method;
        $this->url = $url;
    }

    public function fetch(array $data)
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

    private function getBody(array $data)
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

    public function setTemplate($template)
    {
        $this->template = $template;
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

    public function getUrl()
    {
        return $this->url;
    }
}
