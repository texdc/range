<?php
/**
 * IntegerRangeTest.php
 *
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @copyright 2016 George D. Cooksey, III
 */

namespace texdc\range\test;

use PHPUnit\Framework\TestCase;
use texdc\range\IntegerRange;

class IntegerRangeTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('texdc\range\IntegerRange'));
    }

    public function testClassExtendsAbstractNumericRange()
    {
        $range = IntegerRange::void();
        $this->assertInstanceOf('texdc\range\AbstractNumericRange', $range);
    }

    public function testConstructCastsToInt()
    {
        $range = new IntegerRange('1', 5.23);
        $this->assertSame(1, $range->getStart());
        $this->assertSame(5, $range->getEnd());
    }

    public function testFromUsesIntMax()
    {
        $range = IntegerRange::from(10);
        $this->assertSame(10, $range->getStart());
        $this->assertSame(PHP_INT_MAX, $range->getEnd());
    }

    public function testToUsesNegativeIntMax()
    {
        $range = IntegerRange::to(10);
        $this->assertSame(-PHP_INT_MAX, $range->getStart());
        $this->assertSame(10, $range->getEnd());
    }

    public function testVoidReturnsEmpty()
    {
        $this->assertTrue(IntegerRange::void()->isEmpty());
    }

    /**
     * @param IntegerRange $range
     * @dataProvider getSpanRanges
     */
    public function testSpanReturnsInt(IntegerRange $range)
    {
        $this->assertInternalType('integer', $range->getSpan());
    }

    public function getSpanRanges()
    {
        return [
            [new IntegerRange(1, 3)],
            [new IntegerRange(3, 0)],
        ];
    }

    public function testGetIteratorReturnsArrayIterator()
    {
        $range = new IntegerRange(10, 20);
        $this->assertInstanceOf('ArrayIterator', $range->getIterator());
    }

    public function testGetIteratorRequiresNumericStep()
    {
        $this->expectException(
            'InvalidArgumentException',
            'A numeric (int, float) step value is required'
        );
        IntegerRange::to(10)->getIterator('error');
    }

    /**
     * @param IntegerRange $range
     * @param int          $value
     * @param bool         $result
     * @dataProvider getIncludesRanges
     */
    public function testIncludesReturnsBool(IntegerRange $range, $value, $result)
    {
        $this->assertSame($result, $range->includes($value));
    }

    public function getIncludesRanges()
    {
        return [
            [new IntegerRange(1, 3), 2, true],
            [new IntegerRange(3, 1), '0', false],
        ];
    }

    /**
     * @param IntegerRange $range1
     * @param IntegerRange $range2
     * @dataProvider getDiffRanges
     */
    public function testDiffReturnsInt(IntegerRange $range1, IntegerRange $range2)
    {
        $this->assertInternalType('integer', $range1->diff($range2));
    }

    public function getDiffRanges()
    {
        return [
            [new IntegerRange(0, 3), new IntegerRange(2, 4)],
            [new IntegerRange(0, 3), new IntegerRange(8, 4)],
        ];
    }

    public function testToStringReturnsFormattedString()
    {
        $range = new IntegerRange(1, 4);
        $this->assertSame('1 - 4', (string) $range);
    }
}
