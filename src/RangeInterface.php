<?php
/**
 * RangeInterface.php
 *
 * @copyright 2017 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\range;

use IteratorAggregate;

/**
 * A range is composed of a start value and an end value.  When the values are
 * equal, the range is considered empty.  When the end preceeds the start, it
 * is considered inverted.
 *
 * @author George D. Cooksey, III
 */
interface RangeInterface extends IteratorAggregate
{
    /**
     * @return mixed
     */
    public function getStart();

    /**
     * @return mixed
     */
    public function getEnd();

    /**
     * @return mixed
     */
    public function getSpan();

    /**
     * @return bool
     */
    public function isEmpty() : bool;

    /**
     * @return bool
     */
    public function isInverted() : bool;
}
