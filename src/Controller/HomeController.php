<?php

namespace Tlait\CarForRent\Controller;

use Tlait\CarForRent\Http\Response;

class HomeController extends BaseController
{
    /**
     * @return Response
     */
    public function getIndex():Response
    {
        $template = "home.php";
        return $this->response->view($template);
    }
}
