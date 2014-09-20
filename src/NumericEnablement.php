<?php
/**
 * NumericEnablement.php
 * 
 * @copyright 2014 George D. Cooksey, III
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
     * @param  number $anAmount
     * @return bool
     */
    public function isEnabled($anAmount = 0)
    {
        return $this->numberRange->includes($anAmount);
    }
}
