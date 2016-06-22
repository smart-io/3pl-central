<?php

namespace ThreePlCentral\Test;

use ThreePlCentral\Request;
use ThreePlCentral\ResponseInterface;

class RequestMock extends Request
{
    public function fetch(array $data): ResponseInterface
    {
        if ($this->getUrl() === 'http://www.JOI.com/schemas/ViaSub.WMS/FindOrders') {
            return new ResponseMock(file_get_contents(__DIR__ . '/../files/findOrders/response.xml'));
        }
        throw new \Exception;
    }
}
