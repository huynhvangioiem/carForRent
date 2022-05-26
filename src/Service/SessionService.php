<?php

namespace Tlait\CarForRent\Service;

class SessionService
{
    /**
     * @param  $key
     * @param  $value
     * @return bool
     */
    public function set($key, $value): bool
    {
        $_SESSION[$key] = $value;
        return true;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    /**
     * @param string $key
     * @return bool
     */
    public function unset(string $key): bool
    {
        unset($_SESSION["$key"]);
        return true;
    }
}
