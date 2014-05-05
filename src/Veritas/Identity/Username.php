<?php
/**
 * Username.php
 *
 * @copyright 2014 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Veritas\Identity;

use Veritas\Identity\Exception\UsernameLengthException;

/**
 * Wrap a string as a username credential.
 *
 * This is intended to be extended to also validate characters and words.
 *
 * @author George D. Cooksey, III
 */
class Username implements CredentialInterface
{
    /**#@+
     * Length constraints
     * @var int
     */
    protected static $minLength = 8;
    protected static $maxLength = 125;
    /**#@- */

    /**
     * @var string
     */
    protected $value;


    /**
     * Constructor
     *
     * @param string $value the username
     */
    public function __construct($value)
    {
        $this->value = trim($value);
        static::guardMinimumLength($this->value);
        static::guardMaximumLength($this->value);
    }

    /**
     * (non-PHPdoc)
     * @see Credential::verify()
     */
    public function verify($value)
    {
        return ($this->value == $value);
    }

    /**
     * Compare another username for equality
     *
     * @param  self $other the other username to compare
     * @return bool
     */
    public function equals(self $other)
    {
        return ($this->value == $other->value);
    }

    /**
     * Convert to a string
     *
     * @return string
     */
    public function __toString()
    {
        return $this->value;
    }

    /**
     * Ensure a minimum length
     *
     * @param  string $value the value to check
     * @throws UsernameLengthException
     * @return void
     */
    public static function guardMinimumLength($value)
    {
        if (strlen($value) < static::$minLength) {
            throw UsernameLengthException::minimum(static::$minLength);
        }
    }

    /**
     * Ensure a maximum length
     *
     * @param  string $value the value to check
     * @throws UsernameLengthException
     * @return void
     */
    public static function guardMaximumLength($value)
    {
        if (strlen($value) > static::$maxLength) {
            throw UsernameLengthException::maximum(static::$maxLength);
        }
    }
}
