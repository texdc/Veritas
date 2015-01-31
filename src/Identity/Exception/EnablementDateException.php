<?php
/**
 * EnablementDateException.php
 *
 * @copyright 2015 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Veritas\Identity\Exception;

use DomainException;

/**
 * Builds custom domain exceptions for invalid ranges and missing dates
 *
 * @author George D. Cooksey, III
 */
final class EnablementDateException extends DomainException
{
    /**#@+
     * @var string
     */
    const POSITION_EQUAL   = 'equal';
    const POSITION_FOLLOW  = 'follow';
    const POSITION_PRECEED = 'preceed';
    
    const TYPE_END         = 'end';
    const TYPE_START       = 'start';
    /**#@- */
    
    /**
     * @var string[]
     */
    private static $validPositions = [
        self::POSITION_EQUAL,
        self::POSITION_FOLLOW,
        self::POSITION_PRECEED,
    ];
    
    /**
     * @var string[]
     */
    private static $validTypes = [
        self::TYPE_END,
        self::TYPE_START,
    ];
    
    /**
     * Build an invalid range exception
     *
     * @param  string $position preceed, follow, or equal
     * @return self
     */
    public static function invalidRange($position = self::POSITION_PRECEED)
    {
        if (in_array($position, static::$validPositions)) {
            return new static("The start date must $position the end date");
        }
        return new static("Invalid start or end date(s)");
    }

    /**
     * Build a missing date exception
     *
     * @param  string $type the date type
     * @return self
     */
    public static function missingDate($type = self::TYPE_START)
    {
        if (in_array($type, static::$validTypes)) {
            return new static("The $type date must be provided");
        }
        return new static("Both start and end dates must be provided");
    }
}
