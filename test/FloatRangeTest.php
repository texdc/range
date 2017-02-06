<?php
/**
 * FloatRangeTest.php
 *
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @copyright 2016 George D. Cooksey, III
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
        $this->assertInstanceOf('texdc\range\AbstractNumericRange', $range);
    }

    public function testConstructorCastsToFloat()
    {
        $range = new FloatRange('1', 53);
        $this->assertInternalType('float', $range->getStart());
        $this->assertInternalType('float', $range->getEnd());
    }
}
