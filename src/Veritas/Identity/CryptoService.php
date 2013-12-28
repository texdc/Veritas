<?php
/**
 * CryptoService.php
 *
 * @copyright 2013 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Veritas\Identity;

/**
 * A segregated interface for crypto services
 *
 * Implement a bridge class with this interface to integrate the crypto library of
 * your choice.
 *
 * @author George D. Cooksey, III <texdc3@gmail.com>
 */
interface CryptoService
{
    /**
     * Encrypt a plainText value
     *
     * @param  string $plainText the string to encrypt
     * @return string the encrypted string
     */
    public function encrypt($plainText);
}
