<?php

namespace Tlait\CarForRent\Application;

use Tlait\CarForRent\Controller\CarController;
use Tlait\CarForRent\Controller\HomeController;
use Tlait\CarForRent\Controller\API\AuthenticateAPIController;

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
            Route::get('/', CarController::class, 'index'),
            Route::get('/addcar', CarController::class, 'showAdd'),
            Route::post('/addcar', CarController::class, 'addCar'),
        ];
    }

    /**
     * @return Route[]
     */
    public static function getApiRoutes(): array
    {
        return [
        ];
    }
}
