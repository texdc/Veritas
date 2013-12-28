<?php
/**
 * Password.php
 *
 * @copyright 2013 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Veritas\Identity;

/**
 * Encrypt and verify a plain text string with a crypto service.
 *
 * @author George D. Cooksey, III <texdc3@gmail.com>
 */
class Password implements Credential
{

    /**
     * @var CryptoService
     */
    private $cryptoService;

    /**
     * @var string
     */
    private $encryptedValue;


    /**
     * Constructor
     *
     * @param string        $plainTextValue
     * @param CryptoService $cryptoService
     */
    public function __construct($plainTextValue, CryptoService $cryptoService)
    {
        $this->cryptoService  = $cryptoService;
        $this->encryptedValue = $cryptoService->encrypt($plainTextValue);
    }

    /**
     * (non-PHPdoc)
     * @see \Veritas\Identity\Credential::verify()
     */
    public function verify($plainTextValue)
    {
        return ($this->encryptedValue == $this->cryptoService->encrypt($plainTextValue));
    }

    /**
     * Convert to a string
     *
     * @return string
     */
    public function __toString()
    {
        $format = 'Password [encryptedValue=%s, cryptoService=%s]';
        return sprintf($format, $this->encryptedValue, get_class($this->cryptoService));
    }

    /**
     * Get the crypto service
     *
     * @return CryptoService
     */
    public function cryptoService()
    {
        return $this->cryptoService;
    }

    /**
     * Get the ecrypted value
     *
     * @return string
     */
    public function encryptedValue()
    {
        return $this->encryptedValue;
    }
}
