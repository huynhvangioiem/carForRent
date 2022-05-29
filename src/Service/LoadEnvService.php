<?php

namespace Tlait\CarForRent\Service;

use Dotenv\Dotenv;

class LoadEnvService
{
    private static $loadEnv;

    /**
     * @return Dotenv
     */
    public static function getConnection(): Dotenv
    {
        if (empty(self::$loadEnv)) {
            self::$loadEnv = Dotenv::createImmutable(__DIR__ . '/../../');
        }
        return self::$loadEnv;
    }
}
