<?php
/**
 * MicrotimeRange.php
 *
 * @copyright 2017 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\range;

/**
 * A range composed of two times with millisecond accuracy.
 *
 * @author George D. Cooksey, III
 */
final class MicrotimeRange extends AbstractDateRange
{
    /**#@+
     * @var string
     */
    const DEFAULT_FORMAT   = 'H:i:s.u';
    const DEFAULT_INTERVAL = 'PT1U';
    const DEFAULT_START    = '0000-00-00 00:00:00.000';
    const DEFAULT_END      = '9999-12-31 23:59:59.999';
    const FLOAT_FORMAT     = 'U.u';
    /**#@- */

    /**
     * @return float
     */
    public function getStartAsFloat() : float
    {
        return $this->start->format(static::FLOAT_FORMAT);
    }

    /**
     * @return float
     */
    public function getEndAsFloat() : float
    {
        return $this->end->format(static::FLOAT_FORMAT);
    }
}
