<?php

namespace texdc\range\test;

use DateTime;
use PHPUnit_Framework_TestCase as TestCase;
use texdc\range\DateRange;

class DateRangeTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('texdc\range\DateRange'));
    }

    public function testConstructorRequiresDateTimeInterfaces()
    {
        $exceptionClass = version_compare(PHP_VERSION, '7.0', '<')
            ? 'PHPUnit_Framework_Error'
            : 'TypeError';
        $this->setExpectedException($exceptionClass);
        $range = new DateRange(1, 2);
    }

    public function testFromUsesDefaultEnd()
    {
        $range = DateRange::from(new DateTime);
        $this->assertEquals(new DateTime(DateRange::DEFAULT_END), $range->getEnd());
    }

    public function testToUsesDefaultStart()
    {
        $range = DateRange::to(new DateTime);
        $this->assertEquals(new DateTime(DateRange::DEFAULT_START), $range->getStart());
    }

    public function testVoidReturnsEmptyRange()
    {
        $this->assertTrue(DateRange::void()->isEmpty());
    }

    public function testSpanReturnsDateInterval()
    {
        $this->assertInstanceOf('DateInterval', DateRange::from(new DateTime)->getSpan());
    }

    public function testGetIteratorReturnsDatePeriod()
    {
        $this->assertInstanceOf('DatePeriod', DateRange::from(new DateTime)->getIterator());
    }

    public function testGetIteratorWithTimeString()
    {
        $range = DateRange::from(new DateTime);
        $this->assertInstanceOf('DatePeriod', $range->getIterator('10 years'));
    }

    public function testGetIteratorRequiresDateInterval()
    {
        $this->setExpectedException(
            'InvalidArgumentException',
            'A valid interval string or DateInterval instance is required'
        );
        DateRange::from(new DateTime)->getIterator(1);
    }

    public function testIncludesReturnsBool()
    {
        $range = DateRange::from(new DateTime);
        $this->assertTrue($range->includes(new DateTime('+100 years')));
    }

    public function testIncludesWithInvertedRange()
    {
        $range = new DateRange(new DateTime, new DateTime('-10 years'));
        $this->assertTrue($range->includes(new DateTime('-1 year')));
    }

    public function testDiffReturnsDateInterval()
    {
        $range1 = new DateRange(new DateTime('-1 day'), new DateTime('+1 day'));
        $range2 = new DateRange(new DateTime('+3 days'), new DateTime('+5 days'));
        $this->assertInstanceOf('DateInterval', $range1->diff($range2));
    }

    public function testToStringFormat()
    {
        $start = new DateTime('-1 day');
        $end   = new DateTime('+1 day');
        $range = new DateRange($start, $end);
        $string = $start->format(DateRange::DEFAULT_FORMAT) . ' - ' . $end->format(DateRange::DEFAULT_FORMAT);
        $this->assertSame($string, (string) $range);
    }
}
