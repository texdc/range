<?php
/**
 * NumericRangeInterface.php
 *
 * @copyright 2017 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\range;

/**
 * A range composed of numeric start and end points.
 *
 * @author George D. Cooksey, III
 */
interface NumericRangeInterface extends RangeInterface
{
    /**
     * default iterator step increment
     *
     * @var float
     */
    const DEFAULT_STEP = 1;

    /**
     * @param  float $aValue will be coerced to int, if necessary
     * @return bool
     */
    public function includes(float $aValue) : bool;
}
