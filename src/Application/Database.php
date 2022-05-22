<?php

namespace Tlait\CarForRent\Application;

use Dotenv\Dotenv;
use PDO;
use PDOException;

class Database
{
    private static $connection;
    private static $loadEnv;

    /**
     * @return PDO
     */
    public static function getConnection(): PDO
    {
        if (empty(self::$connection)) {
            self::$loadEnv = Dotenv::createImmutable(__DIR__ . '/../../');
            self::$loadEnv->load();
            $host = $_ENV['DATABASE_HOST'];
            $username = $_ENV['DATABASE_USER'];
            $password = $_ENV['DATABASE_PASSWORD'];
            $database = $_ENV['DATABASE_NAME'];
            try {
                self::$connection = new PDO("mysql:host=$host;dbname=$database", $username, $password);
                // set the PDO error mode to exception
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//            echo "Connected successfully";
            } catch
            (PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }
        return self::$connection;
    }
    public function select(string $string): Database
    {
        return static::$connection;
    }

}
