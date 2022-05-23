<?php

namespace Tlait\CarForRent\Tests\Repository;

use Tlait\CarForRent\Application\Database;
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
     * @dataProvider findByUserNameSuccessProvider
     * @param $params
     * @param $expected
     * @return void
     */
    public function testFindByUserNameSuccess($params, $expected)
    {
        $result = $this->userRepository->findByUserName($params);
        $this->assertEquals($expected['name'], $result->getName());
        $this->assertEquals($expected['username'], $result->getUsername());
        $this->assertEquals($expected['userPhone'], $result->getPhoneNumber());
        $this->assertEquals($expected['userType'], $result->getType());
    }

    /**
     * @return array[]
     */
    public function findByUserNameSuccessProvider(): array
    {
        return [
            'happy-case-1' => [
                'params' => "tlait@gmail.com",
                'expected' => [
                    'name' => 'TLAIT',
                    'username' => 'tlait@gmail.com',
                    'userPhone' => '0335687425',
                    'userType' => 0
                ]
            ]
        ];
    }

    /**
     * @dataProvider findByUserNameNotFoundProvider
     * @param $params
     * @param $expected
     * @return void
     */
    public function testFindByUserNameNotFound($params, $expected)
    {
        $result = $this->userRepository->findByUserName($params);
        $this->assertEmpty($result);

    }

    /**
     * @return array[]
     */
    public function findByUserNameNotFoundProvider(): array
    {
        return [
            'notFoundCase1' => [
                'params' => "abc1123",
                'expected' => []
            ]
        ];
    }


}
