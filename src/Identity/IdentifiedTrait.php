<?php
/**
 * IdentifiedTrait.php
 *
 * @copyright 2014 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Veritas\Identity;

/**
 * Used for authentication and identification
 *
 * @author George D. Cooksey, III
 */
trait IdentifiedTrait
{
    /**
     * @var IdentityInterface
     */
    private $identity;

    /**
     * Verify an identity
     *
     * @param  IdentityInterface $anIdentity
     * @return bool
     */
    public function hasIdentity(IdentityInterface $anIdentity)
    {
        return $this->identity == $anIdentity;
    }

    /**
     * Verify a credential
     *
     * @param  CredentialInterface $aCredential
     * @return bool
     */
    public function hasCredential(CredentialInterface $aCredential)
    {
        return $this->identity->validate($aCredential);
    }
}
