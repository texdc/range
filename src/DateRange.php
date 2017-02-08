<?php
/**
 * DateRange.php
 *
 * @copyright 2017 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\range;

/**
 * A range composed of two dates.
 *
 * @author George D. Cooksey, III
 */
final class DateRange extends AbstractDateRange
{
    /**#@+
     * @var string
     */
    const DEFAULT_START = '0000-00-00';
    const DEFAULT_END   = '9999-12-31';
    /**#@- */
}
