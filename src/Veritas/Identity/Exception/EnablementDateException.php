<?php
/**
 * EnablementDateException.php
 *
 * @copyright 2014 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Veritas\Identity\Exception;

use DomainException;

/**
 * Builds custom domain exceptions for invalid ranges and missing dates
 *
 * @author George D. Cooksey, III
 */
class EnablementDateException extends DomainException
{
    /**
     * Build an invalid range exception
     *
     * @param  string $position preceed, follow, or equal
     * @return self
     */
    public static function invalidRange($position = 'preceed')
    {
        return new static("The start date must $position the end date");
    }

    /**
     * Build a missing date exception
     *
     * @param  string $type the date type
     * @return self
     */
    public static function missingDate($type)
    {
        return new static("The $type date must be provided");
    }
}
