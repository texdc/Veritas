<?php
/**
 * Username.php
 *
 * @copyright 2013 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Veritas\Identity;

use Veritas\Identity\Exception\UsernameLengthException;

/**
 * Wrap a string as a username credential.
 *
 * This is intended to be extended to also validate characters and words.
 *
 * @author George D. Cooksey, III <texdc3@gmail.com>
 */
class Username implements Credential
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
        $this->assertMinimumLength($value);
        $this->assertMaximumLength($value);
        $this->value = (string) $value;
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
    protected function assertMinimumLength($value)
    {
        if (strlen($value) < static::$minLength) {
            throw new UsernameLengthException(
                sprintf('Value must be a minimum of %u characters', static::$minLength)
            );
        }
    }

    /**
     * Ensure a maximum length
     *
     * @param  string $value the value to check
     * @throws UsernameLengthException
     * @return void
     */
    protected function assertMaximumLength($value)
    {
        if (strlen($value) > static::$maxLength) {
            throw new UsernameLengthException(
                sprintf('Value must be a maximum of %u characters', static::$maxLength)
            );
        }
    }
}
