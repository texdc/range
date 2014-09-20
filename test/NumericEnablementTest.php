<?php

namespace texdc\range\test;

use PHPUnit_Framework_TestCase as TestCase;
use texdc\range\NumericEnablement;

class NumericEnablementTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('texdc\range\NumericEnablement'));
    }

    public function testIsEnabledChecksForIncludedDateTime()
    {
        $range = $this->getMockForAbstractClass('texdc\range\NumericRangeInterface');
        $range
            ->expects($this->once())
            ->method('includes')
            ->with(5)
            ->will($this->returnValue(true));

        $enablement = new NumericEnablement($range);
        $this->assertTrue($enablement->isEnabled(5));
    }
}
