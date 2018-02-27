<?php
/**
 * AbstractRange.php
 *
 * @copyright 2017 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\range;

use DomainException;

/**
 * Allows inspection of it's contents and comparisons with other similarly typed ranges.
 *
 * @author George D. Cooksey, III
 */
abstract class AbstractRange implements RangeInterface
{
    /**#@+
     * @var mixed
     */
    protected $start;
    protected $end;
    /**#@- */

    /**
     * @param  self[] $rangeList
     * @return self
     * @throws DomainException if a list item is not an AbstractRange
     */
    public static function combine(array $rangeList) : self
    {
        $combined = static::void();
        foreach ($rangeList as $range) {
            if (!$range instanceof static) {
                throw new DomainException("Range list must contain only " . __CLASS__ . " instances");
            }
            $combined = static::merge($combined, $range);
        }
        return $combined;
    }

    /**
     * @param  self $range1
     * @param  self $range2
     * @return self
     * @throws DomainException if a gap exists between the ranges
     */
    public static function merge(self $range1, self $range2) : self
    {
        if (!$range1->findGapTo($range2)->isEmpty()) {
            throw new DomainException('Ranges must be congruent');
        } elseif ($range1->contains($range2)) {
            return $range1;
        } elseif ($range2->contains($range1)) {
            return $range2;
        } elseif ($range1->isContraryTo($range2)) {
            return static::contraryMerge($range1, $range2);
        } elseif ($range1->overlaps($range2) || $range1->preceeds($range2)) {
            return new static($range1->start, $range2->end);
        }
        return new static($range2->start, $range1->end);
    }

    /**
     * @param  self $range1
     * @param  self $range2
     * @return self
     */
    private static function contraryMerge(self $range1, self $range2) : self
    {
        if ($range1->isInverted()) {
            return new static($range1->end, $range2->end);
        }
        return new static($range1->start, $range2->start);
    }

    /**
     * @return self
     */
    public function reverse() : self
    {
        return new static($this->end, $this->start);
    }

    /**
     * @return bool
     */
    public function isEmpty() : bool
    {
        return $this->start == $this->end;
    }

    /**
     * @return bool
     */
    public function isInverted() : bool
    {
        return $this->start > $this->end;
    }

    /**
     * @param  self $another
     * @return bool true if the two ranges 'move' in opposite directions
     */
    public function isContraryTo(self $another) : bool
    {
        if ($this->isEmpty() || $another->isEmpty()) {
            return false;
        }
        return ($this->isInverted() != $another->isInverted());
    }

    /**
     * @param  self $another
     * @return bool
     */
    public function contains(self $another) : bool
    {
        return $this->includes($another->start) && $this->includes($another->end);
    }

    /**
     * @param  self $another
     * @return bool
     */
    public function overlaps(self $another) : bool
    {
        return (
            !$this->contains($another) && !$another->contains($this)
            && ($this->includes($another->start) || $this->includes($another->end))
        );
    }

    /**
     * @param  self $another
     * @return bool
     */
    public function preceeds(self $another) : bool
    {
        if ($this->isContraryTo($another)) {
            return $this->start <= $another->start || $this->end <= $another->end;
        } elseif ($this->isInverted()) {
            return $this->start <= $another->end;
        }
        return $this->end <= $another->start;
    }

    /**
     * @param  self $another
     * @return bool
     */
    public function follows(self $another) : bool
    {
        if ($this->isContraryTo($another)) {
            return $this->start >= $another->start || $this->end >= $another->end;
        } elseif ($this->isInverted()) {
            return $this->end >= $another->start;
        }
        return $this->start >= $another->end;
    }

    /**
     * @param  self $another
     * @return bool
     */
    public function begins(self $another) : bool
    {
        if ($this->isContraryTo($another)) {
            return $this->end == $another->start && $this->start != $another->end;
        }
        return $this->start == $another->start && $this->end != $another->end;
    }

    /**
     * @param  self $another
     * @return bool
     */
    public function ends(self $another) : bool
    {
        if ($this->isContraryTo($another)) {
            return $this->start == $another->end && $this->end != $another->start;
        }
        return $this->end == $another->end && $this->start != $another->start;
    }

    /**
     * @param  self $another
     * @return bool
     */
    public function abuts(self $another) : bool
    {
        if ($this->isContraryTo($another)) {
            return $this->start == $another->start || $this->end == $another->end;
        }
        return $this->end == $another->start || $this->start == $another->end;
    }

    /**
     * @param  self $another
     * @return self
     */
    public function findGapTo(self $another) : self
    {
        if ($this->abuts($another)
                || $this->contains($another)
                || $another->contains($this)
                || $this->overlaps($another)) {
            return static::void();
        } elseif ($this->isContraryTo($another)) {
            return $this->findContraryGap($another);
        } elseif ($this->follows($another)) {
            return new static($another->end, $this->start);
        }
        return new static($this->end, $another->start);
    }

    /**
     * @param  self $another
     * @return self
     */
    private function findContraryGap(self $another) : self
    {
        if ($this->isInverted()) {
            return new static($this->start, $another->start);
        }
        return new static($this->end, $another->end);
    }
}
