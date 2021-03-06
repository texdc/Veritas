<?php
/**
 * CredentialInterface.php
 *
 * @copyright 2015 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\veritas\identity;

/**
 * Used to authenticate an identity
 *
 * @author George D. Cooksey, III
 */
interface CredentialInterface
{
    /**
     * Verify that a value is valid
     *
     * @param  mixed $value
     * @return bool
     */
    public function verify($value);
}
