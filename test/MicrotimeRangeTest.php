<?php
/**
 * MicrotimeRangeTest.php
 *
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @copyright 2016 George D. Cooksey, III
 */

namespace texdc\range\test;

use PHPUnit\Framework\TestCase;
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
