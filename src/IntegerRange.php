<?php
/**
 * IntegerRange.php
 *
 * @copyright 2014 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\range;

/**
 * A range composed of two integers.
 *
 * @author George D. Cooksey, III
 */
final class IntegerRange extends AbstractNumericRange
{
    /**
     * @param int $start
     * @param int $end
     */
    public function __construct($start, $end)
    {
        $this->start = (int) $start;
        $this->end   = (int) $end;
    }
}
