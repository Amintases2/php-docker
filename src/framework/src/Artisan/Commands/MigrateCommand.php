<?php

namespace PFW\Framework\Artisan\Commands;

use PFW\Framework\Artisan\CommandInterface;

class MigrateCommand implements CommandInterface
{
    private string $name = 'migrate';

    public function execute(array $options = []): int
    {
        return 0;
    }
}
