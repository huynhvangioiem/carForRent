<?php

namespace Tlait\CarForRent\Tests\Controller;

use Tlait\CarForRent\Controller\UserController;
use PHPUnit\Framework\TestCase;
use Tlait\CarForRent\Http\Request;
use Tlait\CarForRent\Model\User;

class UserControllerTest extends TestCase
{
    protected User $user;

    /**
     * @param User $user
     */
    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->user = new User();
        $this->user->setId(1);

    }

    /**
     * @dataProvider loginSuccessProvider
     * @param $params
     * @param $expected
     * @return void
     */
    public function testLoginSuccess($params, $expected)
    {
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $requestMock->expects($this->once())->method("getFormParams")->willReturn($params);

    }

    public function loginSuccessProvider(): array
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'username' => 'tlait@gmail.com',
                    'password' => '231199',
                ],
                'expected' => [
                    'name' => 'Huynh Van Gioi Em',
                    'username' => 'tlait@gmail.com',
                    'userPhone' => '0335687425',
                    'userType' => 0,
                    'id' => 0
                ]
            ],
        ];
    }

}
