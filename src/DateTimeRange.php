<?php
/**
 * DateTimeRange.php
 *
 * @copyright 2017 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\range;

/**
 * A range composed of two datetimes.
 *
 * @author George D. Cooksey, III
 */
final class DateTimeRange extends AbstractDateRange
{
    /**#@+
     * @var string
     */
    const DEFAULT_FORMAT   = 'Y-m-d H:i:s';
    const DEFAULT_START    = '0000-00-00 00:00:00';
    const DEFAULT_END      = '9999-12-31 23:59:59';
    /**#@- */
}
