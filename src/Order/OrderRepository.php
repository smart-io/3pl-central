<?php

namespace ThreePlCentral\Order;

use DateTime;
use ThreePlCentral\ThreePlCentral;
use ThreePlCentral\RequestFactory;

class OrderRepository
{
    public static function findOrders(ThreePlCentral $threepl, DateTime $beginDate, DateTime $endDate): array
    {
        $request = RequestFactory::create(
            $threepl,
            'POST',
            'http://www.JOI.com/schemas/ViaSub.WMS/FindOrders'
        );

        $request->setTemplate(__DIR__ . '/../Request/findOrders.xml');
        $response = $request->fetch([
            'BeginDate' => $beginDate->format('YYYY-MM-DD'),
            'EndDate' => $endDate->format('YYYY-MM-DD')
        ]);
    }
}
