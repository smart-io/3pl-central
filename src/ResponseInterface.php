<?php

namespace ThreePlCentral;

interface ResponseInterface
{
    public function body(): string;
    public function json(): array;
}
