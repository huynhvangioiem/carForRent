<?php

namespace Tlait\CarForRent\Controller;

use Tlait\CarForRent\Http\Request;
use Tlait\CarForRent\Http\Response;

abstract class BaseController
{
    protected Request $request;
    protected Response $response;

    /**
     * @param Request  $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
}
