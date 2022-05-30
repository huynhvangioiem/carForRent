<?php

namespace Tlait\CarForRent\Repository;

use Tlait\CarForRent\Model\User;

class UserRepository extends AbstractRepository
{
    /**
     * @param string $userName
     * @return User|null
     */
    public function findByUserName(string $userName): User | null
    {
        $userSelected = $this->getConnection()->prepare("select * from user where username = ?");
        $userSelected->execute([$userName]);
        $row = $userSelected->fetch();

        if (!$row) {
            return null;
        }

        $user = new User();

        $user->setId($row['id']);
        $user->setUsername($row['username']);
        $user->setPassword($row['password']);
        $user->setName($row['fullname']);
        $user->setPhoneNumber($row['tel']);
        $user->setType($row['type']);

        return $user;
    }
}
