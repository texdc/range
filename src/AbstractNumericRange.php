<?php
/**
 * AbstractNumericRange.php
 *
 * @copyright 2015 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\range;

use ArrayIterator;
use InvalidArgumentException;

/**
 * A range composed of two numbers.
 *
 * @author George D. Cooksey, III
 */
abstract class AbstractNumericRange extends AbstractRange implements NumericRangeInterface
{
    /**
     * @param  number $aValue
     * @return self
     */
    public static function from($aValue)
    {
        return new static($aValue, PHP_INT_MAX);
    }

    /**
     * @param  number $aValue
     * @return self
     */
    public static function to($aValue)
    {
        return new static(-PHP_INT_MAX, $aValue);
    }

    /**
     * @return self
     */
    public static function void()
    {
        return new static(0, 0);
    }

    /**
     * @return number
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @return number
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @return number
     */
    public function getSpan()
    {
        return abs($this->end - $this->start);
    }

    /**
     * @param  number $step the interval amount
     * @return ArrayIterator
     */
    public function getIterator($step = self::DEFAULT_STEP)
    {
        if (!is_numeric($step)) {
            throw new InvalidArgumentException(
                'A numeric (int, float) step value is required'
            );
        }
        return new ArrayIterator(range($this->start, $this->end, $step));
    }

    /**
     * @param  number $aValue
     * @return bool
     */
    public function includes($aValue)
    {
        if ($this->isInverted()) {
            return $aValue <= $this->start && $aValue >= $this->end;
        }
        return $aValue >= $this->start && $aValue <= $this->end;
    }

    /**
     * @param  self $another
     * @return number
     */
    public function diff(self $another)
    {
        return abs($this->getSpan() - $another->getSpan());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return "{$this->start} - {$this->end}";
    }
}
