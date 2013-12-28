<?php
/**
 * Credential.php
 *
 * @copyright 2013 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Veritas\Identity;

/**
 * Used to authenticate an identity
 *
 * @author George D. Cooksey, III <texdc3@gmail.com>
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
