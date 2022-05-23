<?php

namespace Tlait\CarForRent\Tests\Validation;

use Dotenv\Validator;
use Tlait\CarForRent\Exception\ValidationException;
use Tlait\CarForRent\Transfer\UserTransfer;
use Tlait\CarForRent\Validation\UserValidator;
use PHPUnit\Framework\TestCase;

class UserValidatorTest extends TestCase
{
    /**
     * @dataProvider validateSuccessProvider
     * @param $params
     * @param $expected
     * @return void
     */
    public function testValidationSuccess($params, $expected)
    {
        $userTransfer = new UserTransfer();
        $userTransfer->formArray($params);
        $validation = new UserValidator();
        $result = $validation->validate($userTransfer);
        $this->assertEquals($expected, $result);
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
                ],
                'expected' => true
            ],
            'happy-case-2' => [
                'params' => [
                    'username' => 'abc@gmail.com',
                    'password' => '123456',
                ],
                'expected' => true
            ],
            'happy-case-3' => [
                'params' => [
                    'username' => 'tlait@gmail.com',
                    'password' => '674354',
                ],
                'expected' => true
            ],
        ];
    }

    /**
     * @dataProvider validateFailProvider
     * @param $params
     * @param $expected
     * @return void
     */
    public function testValidationFail($params, $expected)
    {
        $userTransfer = new UserTransfer();
        $userTransfer->formArray($params);
        $validation = new UserValidator();
        $this->expectException(ValidationException::class);
        $validation->validate($userTransfer);
    }

    /**
     * @return array[]
     */
    public function validateFailProvider(): array
    {
        return [
            'notFoundCase1' => [
                'params' => [
                    'username' => '',
                    'password' => '231199',
                ],
                'expected' => ""
            ],
            'notFoundCase2' => [
                'params' => [
                    'username' => 'abc@gmail.com',
                    'password' => '',
                ],
                'expected' => ""
            ],
            'notFoundCase3' => [
                'params' => [
                    'username' => '',
                    'password' => '',
                ],
                'expected' => ""
            ],
        ];
    }
}
