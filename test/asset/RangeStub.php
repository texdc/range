<?php
/**
 * RangeStub.php
 *
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @copyright 2016 George D. Cooksey, III
 */

namespace texdc\range\test\asset;

use texdc\range\AbstractRange;

class RangeStub extends AbstractRange
{
    public function __construct($aStart, $anEnd)
    {
        $this->start = $aStart;
        $this->end   = $anEnd;
    }

    public static function void() : self
    {
        return new static(0, 0);
    }

    public function getStart()
    {
        return $this->start;
    }

    public function getEnd()
    {
        return $this->end;
    }

    public function getSpan()
    {
        if ($this->isInverted()) {
            return $this->start - $this->end;
        }
        return $this->end - $this->start;
    }

    public function getIterator()
    {
        // no op
    }

    public function includes($aValue) : bool
    {
        if ($this->isInverted()) {
            return $this->end < $aValue && $this->start > $aValue;
        }
        return $this->start < $aValue && $this->end > $aValue;
    }
}
