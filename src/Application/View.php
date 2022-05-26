<?php

namespace Tlait\CarForRent\Application;

use Tlait\CarForRent\Http\Response;

class View
{
    public function handle(Response $response)
    {
        if (!empty($response->getTemplate())) {
            return Directory::render($response->getTemplate(), $response->getOptions());
        }
        return $this->viewJson($response);
    }

    private function viewJson(Response $response)
    {
        http_response_code($response->getStatusCode());
        foreach ($response->getHeaders() as $key => $value) {
            header("$key:$value;");
        }
        print_r($response->getData());
        return true;
    }
}
