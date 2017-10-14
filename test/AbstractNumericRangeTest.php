<?php
/**
 * AbstractNumericRangeTest.php
 *
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @copyright 2017 George D. Cooksey, III
 */

namespace texdc\range\test;

use PHPUnit\Framework\TestCase;

class AbstractNumericRangeTest extends TestCase
{
    public function testClassExists()
    {
        $this->assertTrue(class_exists('texdc\range\AbstractNumericRange'));
    }

    public function testClassExtendsAbstractRange()
    {
        $mock = $this->getMockForAbstractClass('texdc\range\AbstractNumericRange');
        $this->assertInstanceOf('texdc\range\AbstractRange', $mock);
    }
}
