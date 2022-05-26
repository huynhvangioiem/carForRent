<?php

namespace Tlait\CarForRent\Application;

use Tlait\CarForRent\Http\Request;

class Route
{
    /**
     * @var string
     */
    protected string $method;
    /**
     * @var string
     */
    protected string $uri;
    /**
     * @var string
     */
    protected string $controllerClassName;
    /**
     * @var string
     */
    protected string $actionName;

    /**
     * @param string $method
     * @param string $uri
     * @param string $controllerClassName
     * @param string $actionName
     */
    public function __construct(string $method, string $uri, string $controllerClassName, string $actionName)
    {
        $this->setMethod($method);
        $this->setUri($uri);
        $this->setControllerClassName($controllerClassName);
        $this->setActionName($actionName);
    }


    /**
     * @param  string $uri
     * @param  string $controllerClassName
     * @param  string $actionName
     * @return Route
     */
    public static function post(string $uri, string $controllerClassName, string $actionName): Route
    {
        return new static(Request::methodPost, $uri, $controllerClassName, $actionName);
    }

    /**
     * @param  string $uri
     * @param  string $controllerClassName
     * @param  string $actionName
     * @return Route
     */
    public static function get(string $uri, string $controllerClassName, string $actionName): Route
    {
        return new static(Request::methodGet, $uri, $controllerClassName, $actionName);
    }

    /**
     * @param  string $uri
     * @param  string $controllerClassName
     * @param  string $actionName
     * @return Route
     */
    public static function put(string $uri, string $controllerClassName, string $actionName): Route
    {
        return new static(Request::methodPut, $uri, $controllerClassName, $actionName);
    }

    /**
     * @param  string $uri
     * @param  string $controllerClassName
     * @param  string $actionName
     * @return Route
     */
    public static function delete(string $uri, string $controllerClassName, string $actionName): Route
    {
        return new static(Request::methodDelete, $uri, $controllerClassName, $actionName);
    }

    /**
     * @param  string $method
     * @param  string $uri
     * @return bool
     */
    public function match(string $method, string $uri): bool
    {
        return $this->getMethod() === $method && $this->getUri() === $uri;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod(string $method): void
    {
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }

    /**
     * @param string $uri
     */
    public function setUri(string $uri): void
    {
        $this->uri = $uri;
    }

    /**
     * @return string
     */
    public function getControllerClassName(): string
    {
        return $this->controllerClassName;
    }

    /**
     * @param string $controllerClassName
     */
    public function setControllerClassName(string $controllerClassName): void
    {
        $this->controllerClassName = $controllerClassName;
    }

    /**
     * @return string
     */
    public function getActionName(): string
    {
        return $this->actionName;
    }

    /**
     * @param string $actionName
     */
    public function setActionName(string $actionName): void
    {
        $this->actionName = $actionName;
    }
}
