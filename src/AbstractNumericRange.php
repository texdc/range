<?php
/**
 * AbstractNumericRange.php
 *
 * @copyright 2016 George D. Cooksey, III
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
     * @param  float $aValue will be coerced to int, if necessary
     * @return self
     */
    public static function from(float $aValue) : self
    {
        return new static($aValue, PHP_INT_MAX);
    }

    /**
     * @param  float $aValue will be coerced to int, if necessary
     * @return self
     */
    public static function unto(float $aValue) : self
    {
        return new static(-PHP_INT_MAX, $aValue);
    }

    /**
     * @return self
     */
    public static function void() : self
    {
        return new static(0, 0);
    }

    /**
     * @return numeric
     */
    public function getStart()
    {
        return $this->start;
    }

    /**
     * @return numeric
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * @return numeric
     */
    public function getSpan()
    {
        return abs($this->end - $this->start);
    }

    /**
     * @param  float $step the interval amount
     * @return ArrayIterator
     */
    public function getIterator(float $step = self::DEFAULT_STEP) : ArrayIterator
    {
        return new ArrayIterator(range($this->start, $this->end, $step));
    }

    /**
     * @param  float $aValue will be coerced to int, if necessary
     * @return bool
     */
    public function includes(float $aValue) : bool
    {
        if ($this->isInverted()) {
            return $aValue <= $this->start && $aValue >= $this->end;
        }
        return $aValue >= $this->start && $aValue <= $this->end;
    }

    /**
     * @param  self $another
     * @return numeric
     */
    public function diff(self $another)
    {
        return abs($this->getSpan() - $another->getSpan());
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return "{$this->start} - {$this->end}";
    }
}
