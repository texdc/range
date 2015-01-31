<?php
/**
 * DateEnablement.php
 *
 * @copyright 2015 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\range;

use DateTime;

/**
 * A date-based enablement.
 *
 * @author George D. Cooksey, III
 */
final class DateEnablement implements EnablementInterface
{
    /**
     * @var DateRange
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
     * @param  DateTime|null $onDate optional, will default to 'now'
     * @return bool
     */
    public function isEnabled(DateTime $onDate = null)
    {
        $onDate = $onDate ?: new DateTime;
        return $this->dateRange->includes($onDate);
    }
}
