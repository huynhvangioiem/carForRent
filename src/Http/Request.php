<?php

namespace Tlait\CarForRent\Http;

class Request
{
    const methodOption = "OPTION";
    const methodGet = "GET";
    const methodPost = "POST";
    const methodPut = "PUT";
    const methodDelete = "DELETE";

    /**
     * @return string
     */
    public function getRequestMethod(): string
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * @return string
     */
    public function getRequestUri(): string
    {
        return $_SERVER['REQUEST_URI'];
    }

    /**
     * @return array
     */
    public function getFormParams()
    {
        return $_REQUEST;
    }

    /**
     * @return false|string
     */
    public function getRequestBody()
    {
        return file_get_contents('php://input');
    }

    /**
     * @return mixed
     */
    public function getRequestJsonBody()
    {
        $data = file_get_contents('php://input');

        return json_decode($data, true);
    }

    /**
     * @return bool
     */
    public function isGet(): bool
    {
        if ($this->getRequestMethod() === self::methodGet) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isPost(): bool
    {
        if ($this->getRequestMethod() === self::methodPost) {
            return true;
        }
        return false;
    }
}
