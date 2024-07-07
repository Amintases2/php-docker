<?php

namespace PFW\Framework\Artisan;

use League\Container\Container;

class Application
{
    public function __construct(
        private Container $container
    ) {
    }

    public function run(): int
    {
        $argv = $_SERVER['argv'];
        $commandName = $argv[1] ?? null;

        if (!$commandName) {
            throw new ConsoleException('Invalid console command!');
        }

        $args = array_slice($argv, 2);
        $options = $this->parseOptions($args);

        /** @var CommandInterface $command */
        $command = $this->container->get("console:$commandName");

        return $command->execute($options);
    }

    private function parseOptions(array $args): array
    {
        $options = [];
        foreach ($args as $arg) {
            if (str_starts_with($arg, '--')) {
                $option = explode("=", substr($arg, 2));
                $options[] = $option;
            }
        }
        return $options;
    }
}
