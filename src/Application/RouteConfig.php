<?php

namespace Tlait\CarForRent\Application;

use Tlait\CarForRent\Controller\HomeController;

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
//            Route::get('/login', UserLoginController::class, 'getLoginAction')
        ];
    }

    /**
     * @return Route[]
     */
    public static function getApiRoutes(): array
    {
        return [
//            Route::get('/api', HomeApiController::class, 'getIndexAction'),
//            Route::post('/api/login', UserApiController::class, 'postLoginAction'),
        ];
    }
}
