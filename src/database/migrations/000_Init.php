<?php

use PFW\Framework\Db\ConnectionFactory;

return new class
{
    public function up(ConnectionFactory $connection): void
    {
        $sql = file_get_contents(__DIR__ . '/sql/empty_dump.sql');
        $connection->mysql->exec($sql);
    }
    public function down(ConnectionFactory $connection): void
    {
        $tables = $connection->mysql
            ->query("show tables from {$_ENV['DB_NAME']}")
            ->fetchAll(PDO::FETCH_ASSOC);

        $strTables = implode(
            ", ",
            array_map(fn ($row) => $row["Tables_in_{$_ENV['DB_NAME']}"], $tables)
        );

        $sql = "SET FOREIGN_KEY_CHECKS = 0; \n
                drop tables {$strTables}; \n
                SET FOREIGN_KEY_CHECKS = 1;";
        $connection->mysql->exec($sql);
    }
};
