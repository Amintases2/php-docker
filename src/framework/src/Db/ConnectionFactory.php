<?php

namespace PFW\Framework\Db;

use Doctrine\DBAL\DriverManager;

class ConnectionFactory
{
    public function __construct(
        private mixed $databaseUrl
    ) {
    }

    public function createConnection()
    {
        return DriverManager::getConnection([
            'driver' => 'pdo_mysql',
            'url' => $this->databaseUrl
        ]);
    }
}
