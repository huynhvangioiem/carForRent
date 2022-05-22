<?php

namespace Tlait\CarForRent\Controller;

use Tlait\CarForRent\Http\Response;

class NotFoundController extends BaseController
{

    public const INDEX_ACTION = 'index';

    /**
     * @return Response
     */
    public function index(): Response
    {
        $template = "404.php";
        return $this->response->view($template, [], Response::httpStatusNotFound);
    }
}
