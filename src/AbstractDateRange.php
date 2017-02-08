<?php
/**
 * DateRange.php
 *
 * @copyright 2017 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\range;

use DateInterval;
use DatePeriod;
use DateTime;
use DateTimeInterface;
use InvalidArgumentException;

/**
 * A range composed of two dates.
 *
 * @author George D. Cooksey, III
 */
abstract class AbstractDateRange extends AbstractRange implements DateRangeInterface
{
    /**
     * @param DateTimeInterface $aStart
     * @param DateTimeInterface $anEnd
     */
    public function __construct(DateTimeInterface $aStart, DateTimeInterface $anEnd)
    {
        $this->start = $aStart;
        $this->end   = $anEnd;
    }

    /**
     * @param  DateTimeInterface $aStart
     * @return self
     */
    public static function from(DateTimeInterface $aStart) : self
    {
        return new static($aStart, new DateTime(static::DEFAULT_END));
    }

    /**
     * @param  DateTimeInterface $anEnd
     * @return self
     */
    public static function unto(DateTimeInterface $anEnd) : self
    {
        return new static(new DateTime(static::DEFAULT_START), $anEnd);
    }

    /**
     * @return self
     */
    public static function void() : self
    {
        $now = new DateTime;
        return new static($now, clone $now);
    }

    /**
     * @return DateTimeInterface
     */
    public function getStart() : DateTimeInterface
    {
        return $this->start;
    }

    /**
     * @return DateTimeInterface
     */
    public function getEnd() : DateTimeInterface
    {
        return $this->end;
    }

    /**
     * @return DateInterval
     */
    public function getSpan() : DateInterval
    {
        return $this->start->diff($this->end);
    }

    /**
     * @param  DateInterval|string $anInterval
     * @return DatePeriod
     */
    public function getIterator($anInterval = self::DEFAULT_INTERVAL) : DatePeriod
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
     * @param  DateTimeInterface $aDate
     * @return bool
     */
    public function includes(DateTimeInterface $aDate) : bool
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
    public function diff(self $another) : DateInterval
    {
        $diff = abs($this->getSpan()->s - $another->getSpan()->s);
        return new DateInterval("PT{$diff}S");
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        $start = $this->start->format(static::DEFAULT_FORMAT);
        $end   = $this->end->format(static::DEFAULT_FORMAT);
        return "$start - $end";
    }
}
