<?php

namespace texdc\range\test;

use PHPUnit_Framework_TestCase as TestCase;
use texdc\range\TimeRange;

class TimeRangeTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('texdc\range\TimeRange'));
    }

    public function testGetStartTimestampReturnsInt()
    {
        $range = TimeRange::void();
        $this->assertInternalType('integer', $range->getStartTimestamp());
    }

    public function testGetEndTimestampReturnsInt()
    {
        $range = TimeRange::void();
        $this->assertInternalType('integer', $range->getEndTimestamp());
    }
}
