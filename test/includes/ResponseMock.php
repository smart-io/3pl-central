<?php

namespace ThreePlCentral\Test;

use ThreePlCentral\Response;

class ResponseMock extends Response
{
    private $body;

    public function __construct($body)
    {
        $this->body = $body;
    }

    public function body()
    {
        return $this->body;
    }
}
