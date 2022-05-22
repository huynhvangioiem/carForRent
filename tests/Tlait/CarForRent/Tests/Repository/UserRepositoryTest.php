<?php

namespace Tlait\CarForRent\Tests\Repository;

use Tlait\CarForRent\Application\Database;
use Tlait\CarForRent\Exception\UserNotFoundException;
use Tlait\CarForRent\Repository;
use PHPUnit\Framework\TestCase;
use Tlait\CarForRent\Repository\UserRepository;

class UserRepositoryTest extends TestCase
{
    private UserRepository $userRepository;

    protected function setUp(): void
    {
        $this->userRepository = new UserRepository(Database::getConnection());
    }

    /**
     * @dataProvider findByUserNameProvider
     * @param $params
     * @param $expected
     * @return void
     */
    public function testFindByUserName($params, $expected)
    {
        $result = $this->userRepository->findByUserName($params);
        if ($result) {
            $this->assertEquals($expected['name'], $result->getName());
            $this->assertEquals($expected['username'], $result->getUsername());
            $this->assertEquals($expected['userPhone'], $result->getPhoneNumber());
            $this->assertEquals($expected['userType'], $result->getType());
        }else{
            $this->assertEmpty($result);
        }
    }

    public function findByUserNameProvider()
    {
        return [
            'happy-case-1' => [
                'params' => "tlait@gmail.com",
                'expected' => [
                    'name' => 'Huynh Van Gioi Em',
                    'username' => 'tlait@gmail.com',
                    'userPhone' => '0335687425',
                    'userType' => 0
                ]
            ],
            'happy-case-2' => [
                'params' => "huynhvangioiem@gmail.com",
                'expected' => [
                    'name' => 'Huynh Van Gioi Em',
                    'username' => 'huynhvangioiem@gmail.com',
                    'userPhone' => '0335687425',
                    'userType' => 0
                ]
            ],
            'happy-case-3' => [
                'params' => "tlait@com.com",
                'expected' => [
                    'name' => 'Huynh Van Gioi Em',
                    'username' => 'tlait@gmail.com',
                    'userPhone' => '0335687425',
                    'userType' => 0
                ]
            ],
        ];
    }
}
