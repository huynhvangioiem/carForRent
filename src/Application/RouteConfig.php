<?php

namespace Tlait\CarForRent\Application;

use Tlait\CarForRent\Controller\AuthenticateController;
use Tlait\CarForRent\Controller\CarController;

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
            Route::get('/login', AuthenticateController::class, 'login'),
            Route::post('/login', AuthenticateController::class, 'login'),
            Route::post('/logout', AuthenticateController::class, 'logout'),
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
