<?php
/**
 * TimeRangeTest.php
 *
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @copyright 2016 George D. Cooksey, III
 */

namespace texdc\range\test;

use PHPUnit\Framework\TestCase;
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
