<?php

namespace Tlait\CarForRent\Repository;

use Tlait\CarForRent\Application\Database;
use PDO;
class AbstractRepository
{
    private $connection;


    public function __construct()
    {
        $this->connection = Database::getConnection();
    }

    /**
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->connection;
    }

    /**
     * @param PDO $connection
     */
    public function setConnection(PDO $connection): void
    {
        $this->connection = $connection;
    }

}
