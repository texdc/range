<?php
/**
 * DateEnablementTest.php
 *
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @copyright 2016 George D. Cooksey, III
 */

namespace texdc\range\test;

use DateTime;
use PHPUnit_Framework_TestCase as TestCase;
use texdc\range\DateEnablement;

class DateEnablementTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('texdc\range\DateEnablement'));
    }

    public function testIsEnabledChecksForIncludedDateTime()
    {
        $checkDate = new DateTime;
        $range = $this->getMockForAbstractClass('texdc\range\DateRangeInterface');
        $range
            ->expects($this->once())
            ->method('includes')
            ->with($checkDate)
            ->will($this->returnValue(true));

        $enablement = new DateEnablement($range);
        $this->assertTrue($enablement->isEnabled($checkDate));
    }
}
