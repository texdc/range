<?php
/**
 * EnablementInterface.php
 *
 * @copyright 2017 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\range;

/**
 * Enablements provide rich alternatives to boolean flags
 *
 * @author George D. Cooksey, III
 */
interface EnablementInterface
{
    /**
     * @return bool
     */
    public function isEnabled() : bool;
}
