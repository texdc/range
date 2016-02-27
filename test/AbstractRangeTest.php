<?php
/**
 * AbstractRangeTest.php
 *
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @copyright 2016 George D. Cooksey, III
 */

namespace texdc\range\test;

use PHPUnit_Framework_TestCase as TestCase;
use texdc\range\RangeInterface;
use texdc\range\AbstractRange;
use texdc\range\test\asset\RangeStub;

class AbstractRangeTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('texdc\\range\\AbstractRange'));
    }

    public function testClassInstanceOfRangeInterface()
    {
        $range = RangeStub::void();
        $this->assertInstanceOf('texdc\range\RangeInterface', $range);
    }

    public function testReverseReturnsNewRange()
    {
        $range    = new RangeStub(1, 3);
        $reversed = $range->reverse();
        $this->assertNotSame($range, $reversed);
        $this->assertTrue($reversed->isInverted());
    }

    public function testIsEmptyReturnsBool()
    {
        $range1 = RangeStub::void();
        $range2 = new RangeStub(3, 1);
        $this->assertTrue($range1->isEmpty());
        $this->assertFalse($range2->isEmpty());
    }

    public function testIsInvertedReturnsBool()
    {
        $range1 = new RangeStub(5, 1);
        $range2 = new RangeStub(0, 4);
        $this->assertTrue($range1->isInverted());
        $this->assertFalse($range2->isInverted());
    }

    public function testIsContraryToReturnsTrueWithNonEmptyRanges()
    {
        $range1 = new RangeStub(5, 1);
        $range2 = new RangeStub(2, 4);
        $this->assertTrue($range1->isContraryTo($range2));
    }

    public function testIsContraryToReturnsFalseWithAnEmptyRange()
    {
        $range1 = RangeStub::void();
        $range2 = new RangeStub(-1, 1);
        $this->assertFalse($range1->isContraryTo($range2));
    }

    public function testContainsReturnsBool()
    {
        $range1 = RangeStub::void();
        $range2 = new RangeStub(-1, 1);
        $this->assertFalse($range1->contains($range2));
        $this->assertTrue($range2->contains($range1));
    }

    public function testOverlapsReturnsBool()
    {
        $range1 = RangeStub::void();
        $range2 = new RangeStub(2, 4);
        $range3 = new RangeStub(3, 1);
        $this->assertFalse($range1->overlaps($range2));
        $this->assertTrue($range2->overlaps($range3));
    }

    /**
     * @param RangeInterface $range1
     * @param RangeInterface $range2
     * @dataProvider getPreceedingRanges
     */
    public function testPreceedsRetunsBool(RangeInterface $range1, RangeInterface $range2)
    {
        $this->assertTrue($range1->preceeds($range2));
        $this->assertFalse($range2->preceeds($range1));
    }

    /**
     * @param RangeInterface $range1
     * @param RangeInterface $range2
     * @dataProvider getPreceedingRanges
     */
    public function testFollowsRetunsBool(RangeInterface $range1, RangeInterface $range2)
    {
        $this->assertTrue($range2->follows($range1));
        $this->assertFalse($range1->follows($range2));
    }

    public function getPreceedingRanges()
    {
        return [
            [new RangeStub(3, 1), new RangeStub(4, 7)],
            [new RangeStub(1, 3), new RangeStub(4, 7)],
            [new RangeStub(3, 1), new RangeStub(7, 4)],
        ];
    }

    /**
     * @param RangeInterface $range1
     * @param RangeInterface $range2
     * @param bool           $expectedResult
     * @dataProvider getBeginsRanges
     */
    public function testBeginsReturnsBool(
        RangeInterface $range1,
        RangeInterface $range2,
        $expectedResult = true
    ) {
        $this->assertEquals($expectedResult, $range1->begins($range2));
    }

    public function getBeginsRanges()
    {
        return [
            [new RangeStub(1, 3), new RangeStub(1, 5), true],
            [new RangeStub(1, 3), new RangeStub(1, 3), false],
            [new RangeStub(3, 1), new RangeStub(1, 5), true],
            [new RangeStub(3, 1), new RangeStub(1, 3), false],
        ];
    }

    /**
     * @param RangeInterface $range1
     * @param RangeInterface $range2
     * @param bool           $expectedResult
     * @dataProvider getEndsRanges
     */
    public function testEndsReturnsBool(
        RangeInterface $range1,
        RangeInterface $range2,
        $expectedResult = true
    ) {
        $this->assertEquals($expectedResult, $range1->ends($range2));
    }

    public function getEndsRanges()
    {
        return [
            [new RangeStub(3, 5), new RangeStub(1, 5), true],
            [new RangeStub(1, 3), new RangeStub(1, 3), false],
            [new RangeStub(5, 3), new RangeStub(1, 5), true],
            [new RangeStub(3, 1), new RangeStub(1, 3), false],
        ];
    }

    public function testAbutsChecksContraryRanges()
    {
        $range1 = new RangeStub(2, 0);
        $range2 = new RangeStub(2, 4);
        $this->assertTrue($range1->abuts($range2));
    }

    public function testAbutsChecksSimilarRanges()
    {
        $range1 = new RangeStub(4, 5);
        $range2 = new RangeStub(2, 4);
        $this->assertTrue($range1->abuts($range2));
    }

    public function testFindGapToReturnsEmptyRangeWithAbutal()
    {
        $range1 = new RangeStub(4, 5);
        $range2 = new RangeStub(2, 4);
        $this->assertTrue($range1->findGapTo($range2)->isEmpty());
    }

    public function testFindGapToReturnsEmptyRangeWithContained()
    {
        $range1 = new RangeStub(0, 0);
        $range2 = new RangeStub(-1, 1);
        $this->assertTrue($range1->findGapTo($range2)->isEmpty());
    }

    public function testFindGapToReturnsEmptyRangeWithOverlap()
    {
        $range1 = new RangeStub(3, 5);
        $range2 = new RangeStub(2, 4);
        $this->assertTrue($range1->findGapTo($range2)->isEmpty());
    }

    /**
     * @param RangeInterface $range1
     * @param RangeInterface $range2
     * @dataProvider getGappedContraryRanges
     */
    public function testFindGapToReturnsNonEmptyRangeWithContrary(
        RangeInterface $range1,
        RangeInterface $range2
    ) {
        $this->assertFalse($range1->findGapTo($range2)->isEmpty());
    }

    public function getGappedContraryRanges()
    {
        return [
            [new RangeStub(7, 5), new RangeStub(2, 4)],
            [new RangeStub(5, 7), new RangeStub(3, 0)],
        ];
    }

    public function testFindGapToReturnsNonEmptyRangeWithFollowing()
    {
        $range1 = new RangeStub(0, 1);
        $range2 = new RangeStub(2, 4);
        $this->assertFalse($range1->findGapTo($range2)->isEmpty());
    }

    public function testFindGapToReturnsNonEmptyRangeWithPreceeding()
    {
        $range1 = new RangeStub(2, 4);
        $range2 = new RangeStub(0, 1);
        $this->assertFalse($range1->findGapTo($range2)->isEmpty());
    }

    /**
     * @param RangeInterface $range1
     * @param RangeInterface $range2
     * @dataProvider getCongruentRanges
     */
    public function testMergeWithCongruentRanges(
        RangeInterface $range1,
        RangeInterface $range2,
        RangeInterface $expected
    ) {
        $merged = RangeStub::merge($range1, $range2);
        $this->assertEquals($expected, $merged);
    }

    public function getCongruentRanges()
    {
        return [
            [new RangeStub(-1, 5), new RangeStub(0, 3), new RangeStub(-1, 5)],
            [RangeStub::void(), new RangeStub(-1, 1), new RangeStub(-1, 1)],
            [new RangeStub(3, 0), new RangeStub(2, 4), new RangeStub(0, 4)],
            [new RangeStub(0, 3), new RangeStub(4, 2), new RangeStub(0, 4)],
            [new RangeStub(-1, 1), new RangeStub(0, 5), new RangeStub(-1, 5)],
            [new RangeStub(-1, 5), new RangeStub(5, 7), new RangeStub(-1, 7)],
            [new RangeStub(4, 7), new RangeStub(-1, 4), new RangeStub(-1, 7)],
        ];
    }

    public function testMergeRequiresCongruentRanges()
    {
        $this->setExpectedException('DomainException', 'Ranges must be congruent');
        RangeStub::merge(RangeStub::void(), new RangeStub(1, 5));
    }

    public function testCombineRequiresRangeInstances()
    {
        $this->setExpectedException('DomainException');
        RangeStub::combine([1, 2, 4]);
    }

    public function testCombineAggregatesListedRanges()
    {
        $rangeList = [
            new RangeStub(-1, 1),
            new RangeStub(0, 5),
            new RangeStub(5, 7)
        ];
        $combined = RangeStub::combine($rangeList);
        $this->assertEquals(-1, $combined->getStart());
        $this->assertEquals(7, $combined->getEnd());
    }
}
