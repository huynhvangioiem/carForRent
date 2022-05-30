<?php

namespace Tlait\CarForRent\Application;

use Tlait\CarForRent\Controller\NotFoundController;
use Tlait\CarForRent\Http\Request;
use Tlait\CarForRent\Http\Response;

class Application
{
    private Request $request;

    /**
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }


    /**
     * @return false|Route
     */
    private function getRoute()
    {
        $method = $this->request->getRequestMethod();
        $uri = $this->request->getRequestUri();
        $routes = RouteConfig::getRoutes();
        foreach ($routes as $route) {
            if (!$route->match($method, $uri)) {
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
        /** @var Acl $acl */
        $acl = $container->make(Acl::class);
        $acl->setRoute($route);
        if (!$acl->canAccess()) {
            // return 403;
        }
        $controller = $container->make($controllerClassName);
        /**
         * @var Response $response
         */
        $response = $controller->{$actionName}();
        $view = new View();
        return $view->handle($response);
    }
}
