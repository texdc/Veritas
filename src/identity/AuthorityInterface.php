<?php
/**
 * AuthorityInterface.php
 *
 * @copyright 2015 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\veritas\identity;

/**
 * Register and identify identities
 *
 * @author George D. Cooksey, III
 */
interface AuthorityInterface
{
    /**
     * Register a new set of credentials to an identity
     *
     * @param CredentialInterface|CredentialInterface[] $credentials
     *
     * @return IdentityInterface
     */
    public function register($credentials);

    /**
     * Identify a supposed identity and credentials
     *
     * @param mixed                   $identity
     * @param CredentialInterface|CredentialInterface[] $credentials
     *
     * @return IdentityInterface
     */
    public function identify($identity, $credentials);
}
