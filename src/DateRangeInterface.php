<?php
/**
 * DateRangeInterface.php
 *
 * @copyright 2016 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\range;

use DateTimeInterface;

/**
 * A range compsed of DateTimeInterface instances
 *
 * @author George D. Cooksey, III
 */
interface DateRangeInterface extends RangeInterface
{
    /**#@+
     * @var string
     */
    const DEFAULT_FORMAT   = 'Y-m-d';
    const DEFAULT_INTERVAL = 'P1D';
    /**#@- */

    /**
     * @param  DateTimeInterface $aDate
     * @return bool
     */
    public function includes(DateTimeInterface $aDate) : bool;
}
