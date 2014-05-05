<?php
/**
 * Enablement.php
 *
 * @copyright 2014 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Veritas\Identity;

use DateTime;
use JsonSerializable;
use Serializable;
use Veritas\Identity\Exception\EnablementDateException;

/**
 * Defines an enabled state for a given range of dates
 *
 * @link   https://github.com/VaughnVernon/IDDD_Samples
 * @author George D. Cooksey, III
 */
class Enablement implements Serializable, JsonSerializable
{
    /**
     * @var bool
     */
    private $enabled = false;

    /**
     * @var DateTime
     */
    private $endDate;

    /**
     * @var DateTime
     */
    private $startDate;


    /**
     * Constructor
     *
     * @param bool          $enabled
     * @param DateTime|null $startDate
     * @param DateTime|null $endDate
     */
    public function __construct(
        $enabled = true,
        DateTime $startDate = null,
        DateTime $endDate = null
    ) {
        $this->enabled = (bool) $enabled;
        if (isset($startDate) || isset($endDate)) {
            static::guardNullDate('start', $startDate);
            static::guardNullDate('end', $endDate);
            static::guardValidRange($startDate, $endDate);

            $this->startDate = $startDate;
            $this->endDate   = $endDate;
        }
    }

    /**
     * Ensure a date is not null
     *
     * @param  string        $type start or end
     * @param  DateTime|null $date the date to check
     * @throws EnablementDateException
     */
    public static function guardNullDate($type, DateTime $date = null)
    {
        if (!isset($date)) {
            throw EnablementDateException::missingDate($type);
        }
    }

    /**
     * Ensure the start date preceeds the end date
     *
     * @param  DateTime $start
     * @param  DateTime $end
     * @throws EnablementDateException
     */
    public static function guardValidRange(DateTime $start, DateTime $end)
    {
        if ($start >= $end) {
            throw EnablementDateException::invalidRange();
        }
    }

    /**
     * Check enabled status and optional date for validity
     *
     * @param  DateTime|null $aDate optional, defaults to 'now'
     * @return bool
     */
    public function validate(DateTime $aDate = null)
    {
        return ($this->enabled && $this->validateDate($aDate));
    }

    /**
     * Check optional date for validity
     *
     * Always returns true if start and end dates are not set.
     *
     * @param  DateTime|null $aDate optional, defaults to 'now'
     * @return bool
     */
    private function validateDate(DateTime $aDate = null)
    {
        if (isset($this->startDate) && isset($this->endDate)) {
            $aDate = $aDate ?: new DateTime;
            return ($aDate >= $this->startDate && $aDate <= $this->endDate);
        }
        return true;
    }

    /**
     * @param  self $other
     * @return bool
     */
    public function equals(self $other)
    {
        return (
            $this->enabled      == $other->enabled
            && $this->startDate == $other->startDate
            && $this->endDate   == $other->endDate
        );
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $pattern   = 'Enablement [enabled=%u, startDate=%s, endDate=%s]';
        $format    = 'Y-m-d H:i:s';
        $startDate = (isset($this->startDate)) ? $this->startDate->format($format) : 'N/A';
        $endDate   = (isset($this->endDate)) ? $this->endDate->format($format) : 'N/A';

        return sprintf($pattern, $this->enabled, $startDate, $endDate);
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $enabled   = $this->enabled;
        $endDate   = $this->endDate;
        $startDate = $this->startDate;
        return compact('enabled', 'startDate', 'endDate');
    }

    /**
     * (non-PHPdoc)
     * @see Serializable::serialize()
     */
    public function serialize()
    {
        return serialize($this->jsonSerialize());
    }

    /**
     * (non-PHPdoc)
     * @see Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        $data = unserialize($serialized);
        $this->enabled   = $data['enabled'];
        $this->endDate   = $data['endDate'];
        $this->startDate = $data['startDate'];
    }
}
