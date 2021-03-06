<?php
/**
 * Password.php
 *
 * @copyright 2015 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\veritas\identity;

/**
 * Encrypt and verify a plain text string with a crypto service.
 *
 * @author George D. Cooksey, III
 */
class Password implements CredentialInterface
{

    /**
     * @var CryptoServiceInterface
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
    public function __construct($plainTextValue, CryptoServiceInterface $cryptoService)
    {
        $this->cryptoService  = $cryptoService;
        $this->encryptedValue = $cryptoService->encrypt($plainTextValue);
    }

    /**
     * (non-PHPdoc)
     * @see \texdc\veritas\identity\Credential::verify()
     */
    public function verify($plainTextValue)
    {
        return ($this->encryptedValue == $this->cryptoService->encrypt($plainTextValue));
    }

    /**
     * Compare another password for equality
     *
     * @param  self $other the other password to compare
     * @return bool
     */
    public function equals(self $other)
    {
        return (
            $this->encryptedValue == $other->encryptedValue
            && $this->cryptoService == $other->cryptoService
        );
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
     * @return CryptoServiceInterface
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
