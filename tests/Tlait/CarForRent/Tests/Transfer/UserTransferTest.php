<?php

namespace Tlait\CarForRent\Tests\Transfer;

use Tlait\CarForRent\Transfer\UserTransfer;
use PHPUnit\Framework\TestCase;

class UserTransferTest extends TestCase
{
    private UserTransfer $userTransfer;

    /**
     * @return void
     */
    protected function setUp():void
    {
        $this->userTransfer = new UserTransfer();
    }

    /**
     * @dataProvider formArrayProvider
     * @param $params
     * @param $expected
     * @return void
     */
    public function testFormArray($params, $expected)
    {
        $userTransferResult = $this->userTransfer->formArray($params);

        $this->assertEquals($expected['username'],$userTransferResult->getUsername());
        $this->assertEquals($expected['password'],$userTransferResult->getPassword());
    }
    /**
     * @return array[]
     */
    public function formArrayProvider(): array
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'username' => 'tlait@gmail.com',
                    'name' => 'hvge',
                    'password' => '231199',
                ],
                'expected' => [
                    'username' => 'tlait@gmail.com',
                    'password' => '231199',
                ]
            ],
            'happy-case-2' => [
                'params' => [
                    'username' => 'abc@gmail.com',
                    'password' => '',
                ],
                'expected' => [
                    'username' => 'abc@gmail.com',
                    'password' => '',
                ]
            ],
            'happy-case-3' => [
                'params' => [
                    'username' => '',
                    'password' => '674354',
                ],
                'expected' => [
                    'username' => '',
                    'password' => '674354',
                ]
            ],
        ];
    }

    /**
     * @dataProvider getSetProvider
     * @param $params
     * @param $expected
     * @return void
     */
    public function testGetSet($params, $expected)
    {
        $this->userTransfer->setUsername($params['username']);
        $this->userTransfer->setPassword($params['password']);

        $this->assertEquals($expected['username'],$this->userTransfer->getUsername());
        $this->assertEquals($expected['password'],$this->userTransfer->getPassword());
    }
    /**
     * @return array[]
     */
    public function getSetProvider(): array
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'username' => 'tlait@gmail.com',
                    'name' => 'hvge',
                    'password' => '231199',
                ],
                'expected' => [
                    'username' => 'tlait@gmail.com',
                    'password' => '231199',
                ]
            ],
            'happy-case-2' => [
                'params' => [
                    'username' => 'abc@gmail.com',
                    'password' => '',
                ],
                'expected' => [
                    'username' => 'abc@gmail.com',
                    'password' => '',
                ]
            ],
            'happy-case-3' => [
                'params' => [
                    'username' => '',
                    'password' => '674354',
                ],
                'expected' => [
                    'username' => '',
                    'password' => '674354',
                ]
            ],
        ];
    }
}
