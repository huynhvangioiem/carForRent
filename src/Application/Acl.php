<?php

namespace Tlait\CarForRent\Application;

use Tlait\CarForRent\Http\Request;
use Tlait\CarForRent\Repository\UserRepository;
use Tlait\CarForRent\Service\SessionService;
use Tlait\CarForRent\Service\TokenService;
use Tlait\CarForRent\Service\UserService;

class Acl
{
    private Route $route;
    private Request $request;
    private SessionService $sessionService;
    private TokenService $tokenService;
    private UserService $userService;
    private UserRepository $userRepository;

    /**
     * @param Request $request
     * @param TokenService $tokenService
     * @param UserService $userService
     */
    public function __construct(
        Request        $request,
        TokenService   $tokenService,
        UserService    $userService,
        SessionService $sessionService,
        UserRepository $userRepository
    )
    {
        $this->request = $request;
        $this->tokenService = $tokenService;
        $this->userService = $userService;
        $this->sessionService = $sessionService;
        $this->userRepository = $userRepository;
    }

    public function canAccess()
    {
        $role = $this->route->getRole();
        $sessionUserName = $this->sessionService->get("username");
        if (!$sessionUserName) {
            return false;
        }
        $user = $this->userRepository->findByUserName($sessionUserName);
//        if($user->getType() == ){
//
//        }
        var_dump($user);
    }

    public function setRoute(Route $route): Acl
    {
        $this->route = $route;
        return $this;
    }
}
