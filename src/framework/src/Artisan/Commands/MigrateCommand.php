<?php

namespace PFW\Framework\Artisan\Commands;

use PFW\Framework\Artisan\CommandInterface;
use PFW\Framework\Db\ConnectionFactory;

class MigrateCommand implements CommandInterface
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

            $this->createMigrationsTable();

            $appliedMigrations = $this->getAppliedMigrations();

            $migrationFiles = $this->getMigrationsFiles();

            $migrationsToApply = array_values(array_diff($migrationFiles, $appliedMigrations));

            foreach ($migrationsToApply as $migration) {
                $migrationInstanse = require $this->migrationsPath . "/$migration";
                $migrationInstanse->up($this->connection);

                $this->addMigration($migration);
            }
            $this->connection->mysql->commit();
        } catch (\Exception $e) {
            if ($this->connection->mysql->inTransaction()) {
                $this->connection->mysql->rollBack();
            }
            throw $e;
        }

        return 0;
    }

    private function createMigrationsTable(): void
    {
        $doesExist = $this->connection->mysql
            ->query("SHOW TABLES FROM `test` like 'migrations';")
            ->fetch();

        if (!$doesExist) {
            $migrationsTableSql = 'CREATE TABLE IF NOT EXISTS migrations 
                (id INT AUTO_INCREMENT PRIMARY KEY, 
                migration VARCHAR(255), 
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP)';

            $this->connection->mysql->query($migrationsTableSql)->execute();
            echo 'Migrations table created!' . PHP_EOL;
        }
    }

    private function getAppliedMigrations(): array
    {
        $migrations = $this->connection->mysql
            ->query("SELECT migration FROM migrations;")
            ->fetchAll();

        return array_map(fn ($row) => $row['migration'], $migrations);
    }

    private function getMigrationsFiles(): array
    {
        $migrationFiles = scandir($this->migrationsPath);

        $filtered = array_filter($migrationFiles, fn ($file) => str_ends_with($file, '.php'));

        return array_values($filtered);
    }

    private function addMigration(string $migration): void
    {
        $this->connection->mysql
            ->prepare("INSERT INTO migrations (migration) VALUES (:migration)")
            ->execute(array('migration' => $migration));
    }
}
