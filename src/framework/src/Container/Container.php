<?php

namespace PFW\Framework\Container;

use PFW\Framework\Container\Exceptions\ContainerException;
use Psr\Container\ContainerInterface;
use ReflectionClass;

class Container implements ContainerInterface
{
    private array $services = [];

    public function add(string $id, string|object $concrete = null)
    {
        if (is_null($concrete)) {
            if (!class_exists($id)) {
                throw new ContainerException("Service $id not found");
            }
            $concrete = $id;
        }
        $this->services[$id] = $concrete;
    }

    public function get(string $id)
    {
        if (!$this->has($id)) {
            if (!class_exists($id)) {
                throw new ContainerException("Service $id could not be resolved found");
            }
            $this->add($id);
        }

        $instance = $this->resolve($this->services[$id]);

        return $instance;
    }

    private function resolve(mixed $id)
    {
        $reflectionClass = new ReflectionClass($id);

        $constructor = $reflectionClass->getConstructor();

        if (is_null($constructor)) {
            return $reflectionClass->newInstance();
        }

        $constructorParams = $constructor->getParameters();


        $classDependecies = $this->resolveClassDependencies($constructorParams);

        $instance = $reflectionClass->newInstanceArgs($classDependecies);

        return $instance;
    }

    private function resolveClassDependencies(array $constructorParams)
    {
        $classDependencies = [];

        /** @var \ReflectionParameter $constructorParam  */
        foreach ($constructorParams as $constructorParam) {

            $serviceType = $constructorParam->getType();

            $service = $this->get($serviceType->getName());

            $classDependencies[] = $service;
        }
        return $classDependencies;
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->services);
    }
}
