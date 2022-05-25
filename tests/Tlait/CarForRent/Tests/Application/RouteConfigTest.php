<?php

namespace Tlait\CarForRent\Tests\Application;

use Tlait\CarForRent\Application\RouteConfig;
use PHPUnit\Framework\TestCase;

class RouteConfigTest extends TestCase
{
    public function testGetRoutes()
    {
        $routes = RouteConfig::getRoutes();
        self::assertIsArray($routes);
        self::assertNotEmpty($routes);
    }

}
