<?php

namespace Tlait\CarForRent\Tests\Validation;

use Tlait\CarForRent\Exception\ValidationException;
use Tlait\CarForRent\Transfer\UserTransfer;
use Tlait\CarForRent\Validation\UserValidator;
use PHPUnit\Framework\TestCase;

class UserValidatorTest extends TestCase
{
    /**
     * @dataProvider validateSuccessProvider
     * @param $params
     * @return void
     */
    public function testValidationSuccess($params)
    {
        $userTransfer = new UserTransfer();
        $userTransfer->formArray($params);

        $validation = new UserValidator();
        $result = $validation->validate($userTransfer);

        $this->assertEmpty($result);
    }

    /**
     * @return array[]
     */
    public function validateSuccessProvider(): array
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'username' => 'tlait@gmail.com',
                    'password' => '231199',
                ]
            ],
            'happy-case-2' => [
                'params' => [
                    'username' => 'abc@gmail.com',
                    'password' => '123456',
                ]
            ],
            'happy-case-3' => [
                'params' => [
                    'username' => 'tlait@gmail.com',
                    'password' => '674354',
                ]
            ],
        ];
    }

    /**
     * @dataProvider requiredValidateFailProvider
     * @param $params
     * @return void
     */
    public function testRequiredValidationFaild($params)
    {
        $userTransfer = new UserTransfer();
        $userTransfer->formArray($params);

        $validation = new UserValidator();
        $result = $validation->validate($userTransfer);

        $this->assertNotEmpty($result);
        $this->assertIsString($params['isString']);
        $this->assertArrayNotHasKey($params['notHas'],$result);
    }

    /**
     * @return array[]
     */
    public function requiredValidateFailProvider(): array
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'username' => '',
                    'password' => '231199',
                    'isString' => 'username',
                    'notHas' => 'password'
                ],

            ],
            'happy-case-2' => [
                'params' => [
                    'username' => 'abc@gmail.com',
                    'password' => '',
                    'isString' => 'password',
                    'notHas' => 'username'
                ]
            ]
        ];
    }

    /**
     * @dataProvider maxLengthValidateFailProvider
     * @param $params
     * @return void
     */
    public function testMaxLengthValidationFaild($params)
    {
        $userTransfer = new UserTransfer();
        $userTransfer->formArray($params);

        $validation = new UserValidator();
        $result = $validation->validate($userTransfer);

        $this->assertNotEmpty($result);
        $this->assertIsString($result['username']);
        $this->assertIsString($result['password']);
    }

    /**
     * @return array[]
     */
    public function maxLengthValidateFailProvider(): array
    {
        return [
            'case-1' => [
                'params' => [
                    'username' => 'huynh............................van...........................gioi.....................em.................@gmail.com',
                    'password' => '1111111111111111122222222222222222',
                ],

            ]
        ];
    }

}
