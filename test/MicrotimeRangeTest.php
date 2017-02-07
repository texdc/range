<?php
/**
 * MicrotimeRangeTest.php
 *
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @copyright 2016 George D. Cooksey, III
 */

namespace texdc\range\test;

use DateTime;
use PHPUnit\Framework\TestCase;
use texdc\range\MicrotimeRange;

class MicrotimeRangeTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('texdc\range\MicrotimeRange'));
    }

    public function testFromUsesDefaultEnd()
    {
        $range = MicrotimeRange::from(new DateTime);
        $this->assertEquals(new DateTime(MicrotimeRange::DEFAULT_END), $range->getEnd());
    }

    public function testUntoUsesDefaultStart()
    {
        $range = MicrotimeRange::unto(new DateTime);
        $this->assertEquals(new DateTime(MicrotimeRange::DEFAULT_START), $range->getStart());
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

    public function testToStringFormat()
    {
        $start = new DateTime('-1 day');
        $end   = new DateTime('+1 day');
        $range = new MicrotimeRange($start, $end);
        $string = $start->format(MicrotimeRange::DEFAULT_FORMAT) . ' - ' . $end->format(MicrotimeRange::DEFAULT_FORMAT);
        $this->assertSame($string, (string) $range);
    }
}
