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

            $migrationName = array_values(array_filter(
                scandir($this->migrationsPath),
                fn ($file) => str_starts_with($file, $options[0])
            ))[0] ?? null;

            if (!$migrationName || !str_ends_with($migrationName, '.php')) {
                throw new \Exception('Invalid migration name');
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
        $doesExist = $this->connection->mysql
            ->query("SHOW TABLES FROM `{$_ENV['DB_NAME']}` like 'migrations';")
            ->fetch();

        if ($doesExist) {
            $this->connection->mysql
                ->query("DELETE FROM migrations WHERE migration = '$migrationName'")
                ->execute();
        }
    }
}
