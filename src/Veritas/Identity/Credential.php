<?php
/**
 * Credential.php
 *
 * @copyright 2014 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Veritas\Identity;

/**
 * Used to authenticate an identity
 *
 * @author George D. Cooksey, III
 */
interface Credential
{
    /**
     * Verify that a value is valid
     *
     * @param  mixed $value
     * @return bool
     */
    public function verify($value);
}
