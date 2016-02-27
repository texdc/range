<?php
/**
 * TimeRange.php
 *
 * @copyright 2016 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\range;

/**
 * A range composed of two times.
 *
 * @author George D. Cooksey, III
 */
final class TimeRange extends AbstractDateRange
{
    /**#@+
     * @var string
     */
    const DEFAULT_FORMAT   = 'H:i:s';
    const TIMESTAMP_FORMAT = 'U';
    const DEFAULT_INTERVAL = 'PT1S';
    const DEFAULT_START    = '00:00:00';
    const DEFAULT_END      = '23:59:59';
    /**#@- */

    /**
     * @return int
     */
    public function getStartTimestamp()
    {
        return (int) $this->start->format(static::TIMESTAMP_FORMAT);
    }

    /**
     * @return int
     */
    public function getEndTimestamp()
    {
        return (int) $this->end->format(static::TIMESTAMP_FORMAT);
    }
}
