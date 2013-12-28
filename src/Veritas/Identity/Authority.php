<?php
/**
 * Authority.php
 *
 * @copyright 2013 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Veritas\Identity;

/**
 * Register and identify identities
 *
 * @author George D. Cooksey, III <texdc3@gmail.com>
 */
interface Authority
{
    /**
     * Register a new set of credentials to an identity
     *
     * @param Credential|Credential[] $credentials
     *
     * @return Identity
     */
    public function register($credentials);

    /**
     * Identify a supposed identity and credentials
     *
     * @param mixed                   $identity
     * @param Credential|Credential[] $credentials
     *
     * @return Identity
     */
    public function identify($identity, $credentials);
}
