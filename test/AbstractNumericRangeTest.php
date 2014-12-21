<?php

namespace texdc\range\test;

use PHPUnit_Framework_TestCase as TestCase;

class AbstractNumericRangeTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('texdc\range\AbstractNumericRange'));
    }

    public function testClassExtendsAbstractRange()
    {
        $mock = $this->getMockForAbstractClass('texdc\range\AbstractNumericRange');
        $this->assertInstanceOf('texdc\range\AbstractRange', $mock);
    }
}
