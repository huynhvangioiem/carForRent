<?php

namespace Tlait\CarForRent\Transfer;

class UserTransfer implements TransferInterface
{
    private ?string $username;
    private ?string $password;

    /**
     * @param  array $params
     * @return $this
     */
    public function formArray(array $params): UserTransfer
    {
        $this->username = $params['username'] ?? null;
        $this->password = $params['password'] ?? null;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param  string|null $username
     * @return $this
     */
    public function setUsername(?string $username): UserTransfer
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param  string|null $password
     * @return $this
     */
    public function setPassword(?string $password): UserTransfer
    {
        $this->password = $password;
        return $this;
    }
}
