<?php

namespace ThreePlCentral\Test;

use ThreePlCentral\Response;

class ResponseMock extends Response
{
    private $body;

    public function __construct(string $body)
    {
        $this->body = $body;
    }

    public function body(): string
    {
        return $this->body;
    }
}
