<?php

namespace PFW\Framework\Artisan\Commands;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Types;
use PFW\Framework\Artisan\CommandInterface;
use Doctrine\DBAL\Connection;

class MigrateCommand implements CommandInterface
{
    private string $name = 'migrate';

    private const MIGRATIONS_TABLE = 'migrations';

    public function __construct(
        private Connection $connection,
        private string $migrationsPath
    ) {
    }

    public function execute(array $options = []): int
    {
        try {
            $this->createMigrationsTable();

            $this->connection->beginTransaction();

            $appliedMigration = $this->getAppliedMigrations();

            $migrationFiles = $this->getMigrationsFiles();

            $migrationsToApply = array_values(array_diff($migrationFiles, $appliedMigration));

            $newScheme = new Schema();
            foreach ($migrationsToApply as $migration) {
                $migrationInstanse = require $this->migrationsPath . "/$migration";
                $migrationInstanse->up($newScheme);

                $this->addMigration($migration);
            }

            $sqlArray = $newScheme->toSql($this->connection->getDatabasePlatform());

            foreach ($sqlArray as $sql) {
                $this->connection->executeQuery($sql);
            }

            $this->connection->commit();
        } catch (\Exception $e) {
            $this->connection->rollBack();
            throw $e;
        }

        return 0;
    }

    private function createMigrationsTable(): void
    {
        $schemeManager = $this->connection->createSchemaManager();

        if (!$schemeManager->tablesExist([self::MIGRATIONS_TABLE])) {
            $scheme = new Schema();
            $table = $scheme->createTable('migrations');
            $table->addColumn('id', Types::INTEGER, [
                'unsigned' => true,
                'autoincrement' => true
            ]);
            $table->addColumn('migration', Types::STRING);
            $table->addColumn('created_at', Types::DATETIME_IMMUTABLE, [
                'default' => 'CURRENT_TIMESTAMP'
            ]);
            $table->setPrimaryKey(['id']);

            $sqlArray = $scheme->toSql($this->connection->getDatabasePlatform());

            $this->connection->executeQuery($sqlArray[0]);

            echo 'Migrations table created!' . PHP_EOL;
        }
    }

    private function getAppliedMigrations(): array
    {
        $queryBuiled = $this->connection->createQueryBuilder();
        $queryBuiled
            ->select('migration')
            ->from(self::MIGRATIONS_TABLE);
        return $queryBuiled->executeQuery()->fetchFirstColumn();
    }

    private function getMigrationsFiles(): array
    {
        $migrationFiles = scandir($this->migrationsPath);

        $filtered = array_filter($migrationFiles, fn ($file) => str_ends_with($file, '.php'));

        return array_values($filtered);
    }

    private function addMigration(string $migration): void
    {
        $queryBuiled = $this->connection->createQueryBuilder();
        $queryBuiled->insert(self::MIGRATIONS_TABLE)
            ->values(['migration' => ':migration'])
            ->setParameters(['migration' => $migration])
            ->executeQuery();
    }
}
