<?php
/**
 * UsernameLengthException.php
 *
 * @copyright 2014 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Veritas\Identity\Exception;

use DomainException;

/**
 * An exception for username length constraint violations
 *
 * @author George D. Cooksey, III
 */
class UsernameLengthException extends DomainException
{
    /**#@+
     * Type constants
     * @var string
     */
    const TYPE_DEFAULT = 'length';
    const TYPE_MAXIMUM = 'maximum';
    const TYPE_MINIMUM = 'minimum';
    /**#@-*/

    /**
     * Valid types
     * @var string[]
     */
    protected $validTypes = [
        self::TYPE_DEFAULT,
        self::TYPE_MAXIMUM,
        self::TYPE_MINIMUM
    ];

    /**
     * @var string
     */
    protected $messagePattern = 'Value must have a %s of %u characters';

    /**
     * Constructor
     *
     * @param  int    $length the valid length value
     * @param  string $type   a valid length type
     */
    public function __construct($length, $type = self::TYPE_DEFAULT)
    {
        $type    = (in_array($type, $this->validTypes)) ? $type : static::TYPE_DEFAULT;
        $message = sprintf($this->messagePattern, $type, $length);
        parent::__construct($message);
    }

    /**
     * Builds a maximum length exception
     *
     * @param  int $length the valid length value
     * @return self
     */
    public static function maximum($length)
    {
        return new static($length, static::TYPE_MAXIMUM);
    }

    /**
     * Builds a minimum length exception
     *
     * @param  int $length the valid length value
     * @return self
     */
    public static function minimum($length)
    {
        return new static($length, static::TYPE_MINIMUM);
    }
}
