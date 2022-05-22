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
     * @dataProvider loginDataProvider
     * @return void
     * @throws PasswordInvalidException
     * @throws UserNotFoundException
     */
    public function testLogin($params, $expected)
    {
        $userRepositoryMock = $this->getMockBuilder(UserRepository::class)->disableOriginalConstructor()->getMock();
        $userRepositoryMock->expects($this->once())->method('findByUserName')->willReturn($params['user']);

        $userService = new UserService($userRepositoryMock);
        $userTransfer = new UserTransfer();
        $userTransfer->formArray($params);

        $result = $userService->login($userTransfer);

        $this->assertEquals($expected['name'], $result->getName());
        $this->assertEquals($expected['username'], $result->getUsername());
        $this->assertEquals($expected['userPhone'], $result->getPhoneNumber());
        $this->assertEquals($expected['userType'], $result->getType());

    }

    /**
     * @return array[]
     */
    public function loginDataProvider(): array
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
                    'userType' => 0
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
                    'userType' => 0
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
                    'userType' => 0
                ]
            ],
        ];
    }

    private function getUser(string $userName, string $userPassword, string $name, string $phone, int $type): User
    {
        $user = new User();
        $user->setUsername($userName);
        $user->setName($name);
        $user->setPassword(password_hash($userPassword, PASSWORD_BCRYPT));
        $user->setPhoneNumber($phone);
        $user->setType($type);
        return $user;
    }
}
