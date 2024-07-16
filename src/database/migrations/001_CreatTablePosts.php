<?php

use PFW\Framework\Db\ConnectionFactory;

return new class
{
    public function up(ConnectionFactory $connection): void
    {
        $sql = "create table if not exists posts (
            id int unsigned not null auto_increment primary key,
            title varchar(255) not null,
            content text,
            created_at timestamp default current_timestamp,
            updated_at timestamp default current_timestamp on update current_timestamp
        )";
        $connection->mysql->query($sql)->execute();
    }

    public function down(ConnectionFactory $connection): void
    {
        $sql = "drop table if exists posts";
        $connection->mysql->query($sql)->execute();
    }
};
