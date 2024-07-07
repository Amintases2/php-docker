<?php

use Doctrine\DBAL\Types\Types;

return new class
{
    public function up($scheme): void
    {
        $table = $scheme->createTable('posts');
        $table->addColumn('id', Types::INTEGER, [
            'unsigned' => true,
            'autoincrement' => true
        ]);
        $table->addColumn('title', Types::STRING);
        $table->addColumn('body', Types::TEXT);
        $table->addColumn('created_at', Types::DATETIME_IMMUTABLE, [
            'default' => 'CURRENT_TIMESTAMP'
        ]);
        $table->setPrimaryKey(['id']);
    }

    public function down(): void
    {
        // do nothing
    }
};
