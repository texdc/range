<?php
/**
 * FloatRange.php
 *
 * @copyright 2016 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\range;

/**
 * A range composed of two floats.
 *
 * @author George D. Cooksey, III
 */
final class FloatRange extends AbstractNumericRange
{
    /**
     * @param float $start
     * @param float $end
     */
    public function __construct($start, $end)
    {
        $this->start = (float) $start;
        $this->end   = (float) $end;
    }
}
