<?php

namespace Tlait\CarForRent\Tests\Controller;

use PHPUnit\Framework\TestCase;
use Tlait\CarForRent\Application\Container;
use Tlait\CarForRent\Controller\UserController;
use Tlait\CarForRent\Http\Request;
use Tlait\CarForRent\Http\Response;
use Tlait\CarForRent\Model\User;
use Tlait\CarForRent\Repository\UserRepository;
use Tlait\CarForRent\Service\SessionService;
use Tlait\CarForRent\Service\UserService;
use Tlait\CarForRent\Transfer\UserTransfer;
use Tlait\CarForRent\Validation\UserValidator;

class UserControllerTest extends TestCase
{
    protected UserValidator $userValidator;
    protected UserTransfer $userTransfer;
    protected Response $response;

    /**
     * @return void
     */
    protected function setUp(): void
    {
        $this->userTransfer = new UserTransfer();
        $this->userValidator = new UserValidator();
        $this->response = new Response();
    }


    /**
     * @dataProvider loginSuccessProvider
     * @runInSeparateProcess
     * @param $params
     * @return void
     */
    public function testLoginSuccess($params)
    {
        $requestMock = $this->getMockBuilder(Request::class)->getMock();
        $requestMock->expects($this->once())->method('getFormParams')->willReturn($params);
        $requestMock->expects($this->once())->method('isPost')->willReturn(true);

        $userServiceMock = $this->getMockBuilder(UserService::class)->disableOriginalConstructor()->getMock();
        $userServiceMock->expects($this->once())->method('login')->willReturn($params['user']);

        $sessionServiceMock = $this->getMockBuilder(SessionService::class)->getMock();
        $sessionServiceMock->expects($this->once())->method('set')->willReturn(true);

        $userController = new UserController($requestMock, $this->response, $this->userValidator, $userServiceMock, $sessionServiceMock);
        $result = $userController->login();

//        $expectedResult = new Response();
//        $expectedResult->redirect('/');

//        $this->assertEquals($expectedResult, $result);

    }

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
                'expected' => []
            ],
        ];
    }


    /**
     * @dataProvider loggedProvider
     * @runInSeparateProcess
     * @param $params
     * @return void
     */
    public function testLogined($params)
    {
        $requestMock = $this->getMockBuilder(Request::class)->getMock();

        $userServiceMock = $this->getMockBuilder(UserService::class)->disableOriginalConstructor()->getMock();

        $sessionServiceMock = $this->getMockBuilder(SessionService::class)->getMock();
        $sessionServiceMock->expects($this->once())->method('get')->willReturn($params['username']);

        $userController = new UserController($requestMock, $this->response, $this->userValidator, $userServiceMock, $sessionServiceMock);
        $result = $userController->login();

//        $expectedResult = new Response();
//        $expectedResult->redirect('/');

//        $this->assertEquals($expectedResult, $result);

    }

    public function loggedProvider(): array
    {
        return [
            'logged1' => [
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
                'expected' => []
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
