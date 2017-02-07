<?php
/**
 * TimeRangeTest.php
 *
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @copyright 2016 George D. Cooksey, III
 */

namespace texdc\range\test;

use DateTime;
use PHPUnit\Framework\TestCase;
use texdc\range\TimeRange;

class TimeRangeTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('texdc\range\TimeRange'));
    }

    public function testFromUsesDefaultEnd()
    {
        $range = TimeRange::from(new DateTime);
        $this->assertEquals(new DateTime(TimeRange::DEFAULT_END), $range->getEnd());
    }

    public function testUntoUsesDefaultStart()
    {
        $range = TimeRange::unto(new DateTime);
        $this->assertEquals(new DateTime(TimeRange::DEFAULT_START), $range->getStart());
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

    public function testToStringFormat()
    {
        $start = new DateTime('-1 day');
        $end   = new DateTime('+1 day');
        $range = new TimeRange($start, $end);
        $string = $start->format(TimeRange::DEFAULT_FORMAT) . ' - ' . $end->format(TimeRange::DEFAULT_FORMAT);
        $this->assertSame($string, (string) $range);
    }
}
