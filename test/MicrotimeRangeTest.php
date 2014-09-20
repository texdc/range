<?php

namespace texdc\range\test;

use PHPUnit_Framework_TestCase as TestCase;
use texdc\range\MicrotimeRange;

class MicrotimeRangeTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('texdc\range\MicrotimeRange'));
    }

    public function testGetStartAsFloatReturnsFloat()
    {
        $range = MicrotimeRange::void();
        $this->assertInternalType('float', $range->getStartAsFloat());
    }

    public function testGetEndAsFloatReturnsFloat()
    {
        $range = MicrotimeRange::void();
        $this->assertInternalType('float', $range->getEndAsFloat());
    }
}
