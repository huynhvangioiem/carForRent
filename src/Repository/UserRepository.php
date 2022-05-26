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
        $userSelected = $this->getConnection()->prepare("select * from user where user_name = ?");
        $userSelected->execute([$userName]);
        $row = $userSelected->fetch();

        if (!$row) {
            return null;
        }

        $user = new User();

        $user->setId($row['user_id']);
        $user->setUsername($row['user_name']);
        $user->setPassword($row['user_password']);
        $user->setName($row['user_fullname']);
        $user->setPhoneNumber($row['user_tel']);
        $user->setType($row['user_type']);

        return $user;
    }
}
