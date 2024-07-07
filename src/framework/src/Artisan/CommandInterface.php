<?php

namespace PFW\Framework\Artisan;

interface CommandInterface
{
    public function execute(array $options = []): int;
}
