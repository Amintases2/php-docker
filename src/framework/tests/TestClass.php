<?php

namespace PFW\Framework\Test;

class TestClass
{
    public function __construct(
        private readonly TestClass2 $testClass2
    ) {
    }

    public function getTestClass2()
    {
        return $this->testClass2;
    }
}
