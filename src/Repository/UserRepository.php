<?php

namespace Tlait\CarForRent\Repository;

use Tlait\CarForRent\Model\User;

class UserRepository extends AbstractRepository
{

    /**
     * @param string $userName
     * @return User|null
     */
    public function findByUserName(string $userName): ?User
    {
        $result = $this->getConnection()->prepare("select * from user where user_name = ?");
        $result->execute([$userName]);
        $user = new User();
        $row = $result->fetch();
        if (!$row) return null;

        $user->setId($row['user_id']);
        $user->setUsername($row['user_name']);
        $user->setPassword($row['user_password']);
        $user->setName($row['user_fullname']);
        $user->setPhoneNumber($row['user_tel']);
        $user->setType($row['user_type']);
        return $user;
    }
}
