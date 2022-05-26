<?php

namespace Tlait\CarForRent\Application;

use Tlait\CarForRent\Controller\HomeController;
use Tlait\CarForRent\Controller\API\AuthenticateController;

class RouteConfig
{
    /**
     * @return Route[]
     */
    public static function getRoutes(): array
    {
        return array_merge(static::getApiRoutes(), static::getWebRoutes());
    }

    /**
     * @return Route[]
     */
    public static function getWebRoutes(): array
    {
        return [
            Route::get('/', HomeController::class, 'getIndex'),
        ];
    }

    /**
     * @return Route[]
     */
    public static function getApiRoutes(): array
    {
        return [
            Route::post('/api/login', AuthenticateController::class, 'login'),
        ];
    }
}
