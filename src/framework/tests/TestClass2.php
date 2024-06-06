<?php

namespace PFW\Framework\Test;

class TestClass2
{
    public function __construct(
        private readonly TestClass3 $testClass3
    ) {
    }

    public function getTestClass3()
    {
        return $this->testClass3;
    }
}
