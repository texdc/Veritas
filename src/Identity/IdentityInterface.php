<?php
/**
 * IdentityInterface.php
 *
 * @copyright 2015 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Veritas\Identity;

/**
 * An identity has an identifier and one or more credentials.
 *
 * @author George D. Cooksey, III
 */
interface IdentityInterface
{
    /**
     * Get the identifier
     *
     * @return mixed
     */
    public function identify();

    /**
     * Is the credential valid?
     *
     * @param  CredentialInterface $aCredential
     * @return bool
     */
    public function validate(CredentialInterface $aCredential);
}
