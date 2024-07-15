<?php

namespace PFW\Framework\Artisan\Commands;

use PFW\Framework\Artisan\CommandInterface;
use PFW\Framework\Db\ConnectionFactory;

class RollBackCommand implements CommandInterface
{
    public function __construct(
        private ConnectionFactory $connection,
        private string $migrationsPath
    ) {
    }

    public function execute(array $options = []): int
    {
        try {
            $this->connection->mysql->beginTransaction();
            $migrationName = $options[0];

            if (!$migrationName) {
                throw new \Exception('Invalid migration name');
            }
            if (!str_ends_with($migrationName, '.php')) {
                $migrationName = "$migrationName.php";
            }

            $migrationInstanse = require $this->migrationsPath . "/$migrationName";

            $migrationInstanse->down($this->connection);

            $this->removeMigration($migrationName);

            $this->connection->mysql->commit();
        } catch (\Exception $e) {
            if ($this->connection->mysql->inTransaction()) {
                $this->connection->mysql->rollBack();
            }
            throw $e;
        }
        return 0;
    }

    private function removeMigration($migrationName): void
    {
        $this->connection->mysql
            ->query("DELETE FROM migrations WHERE migration = '$migrationName'")
            ->execute();
    }
}
