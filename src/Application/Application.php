<?php

namespace Tlait\CarForRent\Application;

use Tlait\CarForRent\Controller\NotFoundController;
use Tlait\CarForRent\Http\Request;
use Tlait\CarForRent\Http\Response;

class Application
{
    /**
     * @return false|Route
     */
    private function getRoute()
    {
        $method = Request::getRequestMethod();
        $uri = Request::getRequestUri();
        $routes = RouteConfig::getRoutes();
        foreach ($routes as $route) {
            if ($route->getMethod() !== $method || $route->getUri() !== $uri) {
                continue;
            }
            return $route;
        }
        return false;
    }

    public function start()
    {
        $controllerClassName = NotFoundController::class;
        $actionName = NotFoundController::INDEX_ACTION;
        $route = $this->getRoute();
        if ($route) {
            $controllerClassName = $route->getControllerClassName();
            $actionName = $route->getActionName();
        }
        $container = new Container();

        $controller = $container->make($controllerClassName);
        /** @var Response $response */
        $response = $controller->{$actionName}();
        $view = new View();
        $view->handle($response);
    }
}
