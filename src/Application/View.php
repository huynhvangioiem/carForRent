<?php

namespace Tlait\CarForRent\Application;

use Tlait\CarForRent\Http\Response;

class View
{
    public function handle(Response $response)
    {
        http_response_code($response->getStatusCode());
        if (!empty($response->getTemplate())) {
            require Directory::getViewDir() . $response->getTemplate();
        }
        if (!empty($response->getData())) {
            echo $response->getData();
        }
    }
}
