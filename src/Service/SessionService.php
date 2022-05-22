<?php

namespace Tlait\CarForRent\Service;

class SessionService
{
    /**
     * @param $key
     * @param $value
     * @return void
     */
    public function set($key, $value)
    {
        $_SESSION["$key"] = $value;
    }

    /**
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key)
    {
        if (isset($_SESSION["$key"])) return $_SESSION["$key"];
        return null;
    }

    /**
     * @param string $key
     * @return void
     */
    public function unset(string $key)
    {
        unset($_SESSION["$key"]);
    }
}
