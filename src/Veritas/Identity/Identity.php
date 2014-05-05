<?php
/**
 * Identity.php
 *
 * @copyright 2014 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Veritas\Identity;

/**
 * An identity has an identifier and one or more credentials.
 *
 * @author George D. Cooksey, III
 */
interface Identity
{
    /**
     * The identifier
     *
     * @return mixed
     */
    public function id();

    /**
     * The credentials
     *
     * @return Credential[]
     */
    public function credentials();

    /**
     * Is the credential contained?
     *
     * @param  Credential $credential
     * @return bool
     */
    public function hasCredential(Credential $credential);
}
