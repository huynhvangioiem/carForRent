<?php

namespace Tlait\CarForRent\Application;

use Tlait\CarForRent\Http\Response;

class View
{
    /**
     * @param Response $response
     * @return bool
     */
    public function handle(Response $response): bool
    {
        if (!empty($response->getTemplate())) {
            return Directory::render($response->getTemplate(), $response->getOptions());
        }
        return $this->viewJson($response);
    }

    /**
     * @param Response $response
     * @return bool
     */
    private function viewJson(Response $response): bool
    {
        http_response_code($response->getStatusCode());
        foreach ($response->getHeaders() as $key => $value) {
            header("$key:$value;");
        }
        print_r($response->getData());
        return true;
    }
}
