<?php
/**
 * FloatRangeTest.php
 *
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @copyright 2017 George D. Cooksey, III
 */

namespace texdc\range\test;

use PHPUnit\Framework\TestCase;
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
        $this->assertInstanceOf('texdc\range\FloatRange', $range);
    }

    public function testConstructorCastsToFloat()
    {
        $range = new FloatRange('1', 53);
        $this->assertSame(1.0, $range->getStart());
        $this->assertSame(53.0, $range->getEnd());
    }
}
