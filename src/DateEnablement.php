<?php
/**
 * DateEnablement.php
 *
 * @copyright 2017 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\range;

use DateTimeInterface;

/**
 * A date-based enablement.
 *
 * @author George D. Cooksey, III
 */
final class DateEnablement implements EnablementInterface
{
    /**
     * @var DateRangeInterface
     */
    private $dateRange;

    /**
     * @param DateRangeInterface $aDateRange
     */
    public function __construct(DateRangeInterface $aDateRange)
    {
        $this->dateRange = $aDateRange;
    }

    /**
     * @param  DateTimeInterface|null $onDate optional, will default to 'now'
     * @return bool
     */
    public function isEnabled(DateTimeInterface $onDate = null) : bool
    {
        return $this->dateRange->includes($onDate ?? new DateTime);
    }
}
