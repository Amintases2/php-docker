<?php

namespace PFW\Framework\Test;

use PFW\Framework\Container\Container;
use PFW\Framework\Container\Exceptions\ContainerException;
use PHPUnit\Framework\TestCase;


class ContainerTest extends TestCase
{
    public function test_getting_container_from_servive_string()
    {
        $container = new Container();
        $container->add('some-class', TestClass::class);

        $this->assertEquals(TestClass::class, $container->get('some-class'));
    }

    public function test_getting_container_from_servive_class()
    {
        $container = new Container();
        $container->add(TestClass::class);

        $this->assertEquals(TestClass::class, $container->get(TestClass::class));
    }

    public function test_getting_container_from_servive_underfined()
    {
        $container = new Container();
        $this->expectException(ContainerException::class);

        $container->add('');
    }

    public function test_has_container()
    {
        $container = new Container();
        $container->add('some-class', TestClass::class);
        $container->add(TestClass::class);

        $this->assertTrue($container->has('some-class'));
        $this->assertTrue($container->has(TestClass::class));
        $this->assertFalse($container->has('no-class'));
    }
}
