<?php

namespace Tlait\CarForRent\Tests\Application;

use Tlait\CarForRent\Application\Application;
use PHPUnit\Framework\TestCase;
use Tlait\CarForRent\Http\Request;

class ApplicationTest extends TestCase
{

    /**
     * @dataProvider applicationProvider
     * @param $params
     * @return void
     */
    public function testApplication($params)
    {
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $requestMock->expects(self::once())->method("getRequestMethod")->willReturn($params['method']);
        $requestMock->expects(self::once())->method("getRequestUri")->willReturn($params['Uri']);

        $application = new Application($requestMock);
        self::assertTrue($application->start());
    }

    public function applicationProvider()
    {
        return [
            'case1' => [
                'params' => [
                    'method' => 'GET',
                    'Uri' => "/"
                ]
            ],
            'case2' => [
                'params' => [
                    'method' => 'POST',
                    'Uri' => "/abcxyz"
                ]
            ],
            'case3' => [
                'params' => [
                    'method' => 'PUT',
                    'Uri' => "/abcxyz"
                ]
            ],
            'case4' => [
        'params' => [
            'method' => 'DELETE',
            'Uri' => "/abcxyz"
        ]
    ]
        ];
    }

}
