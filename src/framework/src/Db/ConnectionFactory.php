<?php

namespace PFW\Framework\Db;

use PDO;

class ConnectionFactory
{
    public $mysql = null;

    public function __construct()
    {
    }

    public function createConnection()
    {
        $connection = new PDO(
            "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}",
            'root',
            $_ENV['DB_ROOT_PASSWORD']
        );
        $connection->setAttribute(PDO::ATTR_AUTOCOMMIT, 0);
        $this->mysql = $connection;
    }
}
