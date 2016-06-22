<?php

namespace ThreePlCentral\Test;

use PHPUnit_Framework_TestCase;
use ThreePlCentral\Order\OrderRepository;
use ThreePlCentral\RequestFactory;
use ThreePlCentral\ThreePlCentral;
use DateTime;

class OrderRepositoryTest extends PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        RequestFactory::set(RequestMock::class);
    }

    public function testFindOrders()
    {
        OrderRepository::findOrders(
            new ThreePlCentral('', '', '', '', ''),
            new DateTime('2016-01-01 00:00:00'),
            new DateTime('2016-01-31 00:00:00')
        );
    }
}
