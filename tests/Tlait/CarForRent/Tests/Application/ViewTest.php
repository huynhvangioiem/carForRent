<?php

namespace Tlait\CarForRent\Tests\Application;

use Tlait\CarForRent\Application\View;
use PHPUnit\Framework\TestCase;
use Tlait\CarForRent\Http\Response;

class ViewTest extends TestCase
{
    /**
     * @dataProvider handleProvider
     * @param $params
     * @return void
     */
    public function testHandle($params)
    {
        $response = new Response();
        $response->view($params);
        $view = new View();
        self::assertTrue($view->handle($response));
    }

    public function handleProvider(): array
    {
        return [
            'case-1' => [
                'params' => 'home.php'
            ],
            'case-2' => [
                'params' => 'login.php'
            ],
            'case-3' => [
                'params' => '404.php'
            ]
        ];
    }
}
