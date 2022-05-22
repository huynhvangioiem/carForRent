<?php

namespace Tlait\CarForRent\Service;

use Tlait\CarForRent\Exception\PasswordInvalidException;
use Tlait\CarForRent\Exception\UserNotFoundException;
use Tlait\CarForRent\Model\User;
use Tlait\CarForRent\Repository\UserRepository;
use Tlait\CarForRent\Transfer\UserTransfer;

class UserService
{
    private UserRepository $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UserTransfer $userTransfer
     * @return User
     * @throws PasswordInvalidException
     * @throws UserNotFoundException
     */
    public function login(UserTransfer $userTransfer): User
    {
        $user = $this->userRepository->findByUserName($userTransfer->getUsername());
        if (empty($user)) {
            throw new UserNotFoundException();
        }
        $hashedPassword = $user->getPassword();
        $plainPassword = $userTransfer->getPassword();
        if(!$this->checkPassword($plainPassword, $hashedPassword)){
            throw new PasswordInvalidException();
        }
        return $user;
    }

    private function checkPassword($plainPassword, $hashedPassword): bool
    {
        return password_verify($plainPassword, $hashedPassword);
    }

}
