<?php

namespace texdc\range\test;

use PHPUnit_Framework_TestCase as TestCase;
use texdc\range\FloatRange;

class FloatRangeTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('texdc\range\FloatRange'));
    }

    public function testClassExtendsAbstractNumericRange()
    {
        $range = FloatRange::void();
        $this->assertInstanceOf('texdc\range\AbstractNumericRange', $range);
    }

    public function testConstructorCastsToFloat()
    {
        $range = new FloatRange('1', 53);
        $this->assertInternalType('float', $range->getStart());
        $this->assertInternalType('float', $range->getEnd());
    }
}
