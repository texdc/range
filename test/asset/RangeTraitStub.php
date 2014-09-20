<?php

namespace texdc\range\test\asset;

use texdc\range\RangeInterface;

class RangeTraitStub implements RangeInterface
{
    use \texdc\range\RangeTrait;

    public function __construct($aStart, $anEnd)
    {
        $this->start = $aStart;
        $this->end   = $anEnd;
    }

    public static function void()
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

    public function includes($aValue)
    {
        if ($this->isInverted()) {
            return $this->end < $aValue && $this->start > $aValue;
        }
        return $this->start < $aValue && $this->end > $aValue;
    }
}
