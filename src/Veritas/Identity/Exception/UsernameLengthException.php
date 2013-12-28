<?php
/**
 * UsernameLengthException.php
 *
 * @copyright 2013 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Veritas\Identity\Exception;

use DomainException;

/**
 * An exception for username length constraint violations
 *
 * @author George D. Cooksey, III <texdc3@gmail.com>
 */
class UsernameLengthException extends DomainException
{
}
