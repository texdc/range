<?php
/**
 * DateTimeRangeTest.php
 *
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @copyright 2017 George D. Cooksey, III
 */

namespace texdc\range\test;

use DateTime;
use PHPUnit\Framework\TestCase;
use texdc\range\DateTimeRange;

class DateTimeRangeTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('texdc\range\DateTimeRange'));
    }

    public function testFromUsesDefaultEnd()
    {
        $range = DateTimeRange::from(new DateTime);
        $this->assertEquals(new DateTime(DateTimeRange::DEFAULT_END), $range->getEnd());
    }

    public function testUntoUsesDefaultStart()
    {
        $range = DateTimeRange::unto(new DateTime);
        $this->assertEquals(new DateTime(DateTimeRange::DEFAULT_START), $range->getStart());
    }

    public function testToStringFormat()
    {
        $start = new DateTime('-1 day');
        $end   = new DateTime('+1 day');
        $range = new DateTimeRange($start, $end);
        $string = $start->format(DateTimeRange::DEFAULT_FORMAT) . ' - ' . $end->format(DateTimeRange::DEFAULT_FORMAT);
        $this->assertSame($string, (string) $range);
    }
}
