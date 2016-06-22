<?php

namespace ThreePlCentral;

class RequestFactory
{
    private static $class = Request::class;

    public static function set(string $class)
    {
        self::$class = $class;
    }

    public static function create(ThreePlCentral $threepl, string $method, string $url): RequestInterface
    {
        $classname = self::$class;
        $instance = new $classname($method, $url);
        $instance->setId($threepl->getId());
        $instance->setCustomerId($threepl->getCustomerId());
        $instance->setFacilityId($threepl->getFacilityId());
        $instance->setLogin($threepl->getLogin());
        $instance->setPassword($threepl->getPassword());
        return $instance;
    }
}
