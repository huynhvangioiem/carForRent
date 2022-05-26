<?php

namespace Tlait\CarForRent\Service;

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
     * @return array|User
     *  if success with return a user object, else return an error message array
     */
    public function login(UserTransfer $userTransfer): array | User
    {

        $user = $this->userRepository->findByUserName($userTransfer->getUsername());

        if (
            !empty($user)
            && $this->checkPassword($userTransfer->getPassword(), $user->getPassword())
        ) {
            return $user;
        }
        return ['errorMessage' => "login failed!"];
    }

    private function checkPassword(string | null $plainPassword, string $hashedPassword): bool
    {
        return password_verify($plainPassword, $hashedPassword);
    }
}
