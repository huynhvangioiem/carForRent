<?php

namespace Tlait\CarForRent\Tests\Service;

use Tlait\CarForRent\Service\SessionService;
use PHPUnit\Framework\TestCase;

class SessionServiceTest extends TestCase
{
    /**
     * @dataProvider sessionServiceSuccessProvider
     * @return void
     */
    public function testSessionServiceSuccess($params)
    {
        $sessionService = new SessionService();

        $sessionService->set($params['key'],$params['value']);
        self::assertEquals($sessionService->get($params['key']),$params['value']);

        $sessionService->unset($params['key']);
        self::assertEmpty($sessionService->get($params['key']));
    }

    public function sessionServiceSuccessProvider(): array
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'key' => 'username',
                    'value' => 'tlait@gmail.com',
                ]
            ]
        ];
    }


}
