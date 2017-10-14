<?php
/**
 * NumericEnablement.php
 *
 * @copyright 2017 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\range;

/**
 * A number-based enablement.
 *
 * @author George D. Cooksey, III
 */
final class NumericEnablement implements EnablementInterface
{
    /**
     * @var NumericRangeInterface
     */
    private $numberRange;

    /**
     * @param NumericRangeInterface $aNumericRange
     */
    public function __construct(NumericRangeInterface $aNumericRange)
    {
        $this->numberRange = $aNumericRange;
    }

    /**
     * @param  float $anAmount will be coerced to int, if necessary
     * @return bool
     */
    public function isEnabled(float $anAmount = 0) : bool
    {
        return $this->numberRange->includes($anAmount);
    }
}
