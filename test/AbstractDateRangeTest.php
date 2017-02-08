<?php
/**
 * AbstractDateRangeTest.php
 *
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @copyright 2017 George D. Cooksey, III
 */

namespace texdc\range\test;

use PHPUnit\Framework\TestCase;

class AbstractDateRangeTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('texdc\range\AbstractDateRange'));
    }

    public function testClassExtendsAbstractRange()
    {
        $mock = $this->getMockForAbstractClass('texdc\range\AbstractDateRange', [], 'MockDateRange', false);
        $this->assertInstanceOf('texdc\range\AbstractRange', $mock);
    }
}
