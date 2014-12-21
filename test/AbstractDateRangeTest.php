<?php

namespace texdc\range\test;

use PHPUnit_Framework_TestCase as TestCase;

class AbstractDateRangeTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('texdc\range\AbstractDateRange'));
    }

    public function testClassExtendsAbstractRange()
    {
        $mock = $this->getMockForAbstractClass('texdc\range\AbstractDateRange', [], 'MockDateRange', false);
        $this->assertInstanceOf('texdc\range\AbstractRange', $mock);
    }
}
