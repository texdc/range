<?php
/**
 * DateRange.php
 *
 * @copyright 2015 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\range;

use DateInterval;
use DatePeriod;
use DateTime;
use InvalidArgumentException;

/**
 * A range composed of two dates.
 *
 * @author George D. Cooksey, III
 */
abstract class AbstractDateRange extends AbstractRange implements DateRangeInterface
{
    /**#@+
     * @var string
     */
    const DEFAULT_START = '0000-00-00';
    const DEFAULT_END   = '9999-12-31';
    /**#@- */

    /**
     * @param DateTime $aStart
     * @param DateTime $anEnd
     */
    public function __construct(DateTime $aStart, DateTime $anEnd)
    {
        $this->start = $aStart;
        $this->end   = $anEnd;
    }

    /**
     * @param  DateTime $aStart
     * @return self
     */
    public static function from(DateTime $aStart)
    {
        return new static($aStart, new DateTime(static::DEFAULT_END));
    }

    /**
     * @param  DateTime $anEnd
     * @return self
     */
    public static function to(DateTime $anEnd)
    {
        return new static(new DateTime(static::DEFAULT_START), $anEnd);
    }

    /**
     * @return self
     */
    public static function void()
    {
        $now = new DateTime;
        return new static($now, clone $now);
    }

    /**
     * @return DateTimeInterface
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @return DateTimeInterface
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @return DateInterval
     */
    public function getSpan()
    {
        return $this->start->diff($this->end);
    }

    /**
     * @param  DateInterval|string $anInterval
     * @return DatePeriod
     */
    public function getIterator($anInterval = self::DEFAULT_INTERVAL)
    {
        if (is_string($anInterval)) {
            $anInterval = (strpos($anInterval, 'P') === 0)
                        ? new DateInterval($anInterval)
                        : DateInterval::createFromDateString($anInterval);
        }
        if (!$anInterval instanceof DateInterval) {
            throw new InvalidArgumentException(
                'A valid interval string or DateInterval instance is required'
            );
        }
        return new DatePeriod($this->start, $anInterval, $this->end);
    }

    /**
     * @param  DateTime $aDate
     * @return bool
     */
    public function includes(DateTime $aDate)
    {
        if ($this->isInverted()) {
            return $this->start >= $aDate && $this->end <= $aDate;
        }
        return $this->start <= $aDate && $this->end >= $aDate;
    }

    /**
     * @param  self $another
     * @return DateInterval
     */
    public function diff(self $another)
    {
        $span1 = $this->getSpan()->s;
        $span2 = $another->getSpan()->s;
        $diff  = ($span1 >= $span2) ? $span1 - $span2 : $span2 - $span1;
        return new DateInterval("PT{$diff}S");
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $start = $this->start->format(static::DEFAULT_FORMAT);
        $end   = $this->end->format(static::DEFAULT_FORMAT);
        return "$start - $end";
    }
}
