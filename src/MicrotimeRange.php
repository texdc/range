<?php
/**
 * MicrotimeRange.php
 *
 * @copyright 2015 George D. Cooksey, III
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
    const FLOAT_FORMAT     = 'U.u';
    const DEFAULT_INTERVAL = 'PT1U';
    /**#@- */

    /**
     * @return float
     */
    public function getStartAsFloat()
    {
        return (float) $this->start->format(static::FLOAT_FORMAT);
    }

    /**
     * @return float
     */
    public function getEndAsFloat()
    {
        return (float) $this->end->format(static::FLOAT_FORMAT);
    }
}
