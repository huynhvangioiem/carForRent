<?php

namespace Tlait\CarForRent\Tests\Service;

use Tlait\CarForRent\Exception\PasswordInvalidException;
use Tlait\CarForRent\Exception\UserNotFoundException;
use Tlait\CarForRent\Model\User;
use Tlait\CarForRent\Repository\UserRepository;
use PHPUnit\Framework\TestCase;
use Tlait\CarForRent\Service\UserService;
use Tlait\CarForRent\Transfer\UserTransfer;

class UserServiceTest extends TestCase
{
    /**
     * @dataProvider loginSuccessProvider
     * @return void
     * @throws PasswordInvalidException
     * @throws UserNotFoundException
     */
    public function testLoginSuccess($params, $expected)
    {
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('findByUserName')->willReturn($params['user']);

        $userService = new UserService($userRepositoryMock);
        $userTransfer = new UserTransfer();
        $userTransfer->formArray($params);

        $user = $userService->login($userTransfer);

        $this->assertEquals($expected['id'], $user->getId());
        $this->assertEquals($expected['name'], $user->getName());
        $this->assertEquals($expected['username'], $user->getUsername());
        $this->assertEquals($expected['userPhone'], $user->getPhoneNumber());
        $this->assertEquals($expected['userType'], $user->getType());

    }

    /**
     * @return array[]
     */
    public function loginSuccessProvider(): array
    {
        return [
            'happy-case-1' => [
                'params' => [
                    'username' => 'tlait@gmail.com',
                    'password' => '231199',
                    'user' => $this->getUser(
                        'tlait@gmail.com',
                        '231199',
                        'Huynh Van Gioi Em',
                        '0335687425',
                        0
                    )
                ],
                'expected' => [
                    'name' => 'Huynh Van Gioi Em',
                    'username' => 'tlait@gmail.com',
                    'userPhone' => '0335687425',
                    'userType' => 0,
                    'id' => 0
                ]
            ],
            'happy-case-2' => [
                'params' => [
                    'username' => 'abcdef@gmail.com',
                    'password' => '123abcxyz',
                    'user' => $this->getUser(
                        'abcdef@gmail.com',
                        '123abcxyz',
                        'Huynh Van Gioi Em',
                        '0123456789',
                        0
                    )
                ],
                'expected' => [
                    'name' => 'Huynh Van Gioi Em',
                    'username' => 'abcdef@gmail.com',
                    'userPhone' => '0123456789',
                    'userType' => 0,
                    'id' => 0
                ]
            ],
            'happy-case-3' => [
                'params' => [
                    'username' => 'hvge@abc.it',
                    'password' => 'abcxyza',
                    'user' => $this->getUser(
                        'hvge@abc.it',
                        'abcxyza',
                        'Nguyen Van Ten',
                        '0335162354',
                        0
                    )
                ],
                'expected' => [
                    'name' => 'Nguyen Van Ten',
                    'username' => 'hvge@abc.it',
                    'userPhone' => '0335162354',
                    'userType' => 0,
                    'id' => 0
                ]
            ],
        ];
    }

    /**
     * @dataProvider loginUserNotFoundProvider
     * @return void
     * @throws PasswordInvalidException
     * @throws UserNotFoundException
     */
    public function testLoginUserNotFound($params, $expected)
    {
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('findByUserName')->willReturn($params['user']);

        $userService = new UserService($userRepositoryMock);
        $userTransfer = new UserTransfer();
        $userTransfer->formArray($params);

        $error = $userService->login($userTransfer);
        $this->assertEquals($expected, $error['errorMessage']);
    }

    /**
     * @return array[]
     */
    public function loginUserNotFoundProvider(): array
    {
        return [
            'notFoundCase1' => [
                'params' => [
                    'username' => 'tlait@gmail.com',
                    'password' => '231199',
                    'user' => null
                ],
                'expected' => "login failed!"
            ],
            'notFoundCase2' => [
                'params' => [
                    'username' => 'abc@gmail.com',
                    'password' => '231199',
                    'user' => null
                ],
                'expected' => "login failed!"
            ],
            'notFoundCase3' => [
                'params' => [
                    'username' => 'hvge@gmail.com',
                    'password' => '231199',
                    'user' => null
                ],
                'expected' => "login failed!"
            ],
        ];
    }

    /**
     * @dataProvider loginUserPasswordInvalidProvider
     * @param $params
     * @param $expected
     * @return void
     * @throws PasswordInvalidException
     * @throws UserNotFoundException
     */
    public function testLoginUserPasswordInvalid($params, $expected)
    {
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('findByUserName')->willReturn($params['user']);

        $userService = new UserService($userRepositoryMock);
        $userTransfer = new UserTransfer();
        $userTransfer->formArray($params);

        $error = $userService->login($userTransfer);
        $this->assertEquals($expected, $error['errorMessage']);


    }

    /**
     * @return array[]
     */
    public function loginUserPasswordInvalidProvider(): array
    {
        return [
            'passwordWrong1' => [
                'params' => [
                    'username' => 'tlait@gmail.com',
                    'password' => '231199',
                    'user' => $this->getUser(
                        'tlait@gmail.com',
                        '123456',
                        'Huynh Van Gioi Em',
                        '0335687425',
                        0
                    )
                ],
                'expected' => "login failed!"
            ],
            'passwordWrong2' => [
                'params' => [
                    'username' => 'hvge@gmail.com',
                    'password' => '123456',
                    'user' => $this->getUser(
                        'hvge@gmail.com',
                        '456123',
                        'TLAIT',
                        '0335687425',
                        0
                    )
                ],
                'expected' => "login failed!"
            ],
            'passwordWrong3' => [
                'params' => [
                    'username' => 'abc@gmail.com',
                    'password' => '231199',
                    'user' => $this->getUser(
                        'abc@gmail.com',
                        '1233123',
                        'Huynh Van Gioi Em',
                        '0335687425',
                        0
                    )
                ],
                'expected' => "login failed!"
            ],
        ];
    }

    private function getUser(string $userName, string $userPassword, string $name, string $phone, int $type): User
    {
        $user = new User();
        $user->setId(0);
        $user->setUsername($userName);
        $user->setName($name);
        $user->setPassword(password_hash($userPassword, PASSWORD_BCRYPT));
        $user->setPhoneNumber($phone);
        $user->setType($type);
        return $user;
    }
}
