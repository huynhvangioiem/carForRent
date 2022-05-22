<?php

namespace Tlait\CarForRent\Transfer;

class UserTransfer implements TransferInterface
{
    private ?string $username;
    private ?string $password;

    /**
     * @param array $params
     * @return void
     */
    public function formArray(array $params)
    {
        $this->username = $params['username'] ?? null;
        $this->password = $params['password'] ?? null;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string|null $username
     */
    public function setUsername(?string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string|null $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }


}
