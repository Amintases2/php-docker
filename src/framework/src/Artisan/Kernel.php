<?php

namespace PFW\Framework\Artisan;

use League\Container\Container;
use PFW\Framework\Artisan\CommandInterface;

class Kernel
{
    public function __construct(
        private Container $container,
    ) {
    }

    public function handle(): int
    {
        $status = $this->run();

        dd($status);
    }


    private function run(): int
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
        foreach ($args as $key => $arg) {
            if (str_starts_with($arg, '--')) {
                $option = explode("=", substr($arg, 2));
                $options[] = $option;
            } else {
                $options[] = $arg;
            }
        }
        return $options;
    }
}
