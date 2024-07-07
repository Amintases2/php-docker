<?php

namespace PFW\Framework\Artisan;

use League\Container\Container;
use PFW\Framework\Artisan\CommandInterface;

class Kernel
{
    public function __construct(
        private Container $container,
        private Application $application
    ) {
    }

    public function handle(): int
    {
        $this->registerCommands();

        $status = $this->application->run();

        dd($status);

        return 0;
    }

    private function registerCommands(): void
    {
        $commandFiles = new \DirectoryIterator(__DIR__ . '/Commands');
        $namespace = $this->container->get('framework-commands-namespace');
        foreach ($commandFiles as $commandFile) {
            if (!$commandFile->isFile() || !$commandFile->getExtension() === 'php') {
                continue;
            }

            $command = $namespace . pathinfo($commandFile, PATHINFO_FILENAME);

            if (is_subclass_of($command, CommandInterface::class)) {
                $name = (new \ReflectionClass($command))->getProperty('name')->getDefaultValue();
                $this->container->add("console:$name", $command);
            }
        }
    }
}
