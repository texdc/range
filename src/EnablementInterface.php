<?php
/**
 * EnablementInterface.php
 * 
 * @copyright 2015 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\range;

/**
 * Allow various types of enablements, e.g. date, integer, etc.
 * 
 * @author George D. Cooksey, III
 */
interface EnablementInterface
{
    /**
     * @return bool
     */
    public function isEnabled();
}
