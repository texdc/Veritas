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
final class Enablement implements Serializable, JsonSerializable
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
            $this->guardNullDate('start', $startDate);
            $this->guardNullDate('end', $endDate);
            $this->guardValidRange($startDate, $endDate);

            $this->startDate = $startDate;
            $this->endDate   = $endDate;
        }
    }

    /**
     * Check enabled status and optional date for validity
     *
     * @param  DateTime|null $onDate optional, defaults to 'now'
     * @return bool
     */
    public function isValid(DateTime $onDate = null)
    {
        return ($this->enabled && $this->validateDate($onDate));
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
        if ($this->isTemporal()) {
            $aDate = $aDate ?: new DateTime;
            return ($aDate >= $this->startDate && $aDate <= $this->endDate);
        }
        return true;
    }

    /**
     * Check the enabled status
     *
     * @return bool
     */
    public function isEnabled() {
        return $this->enabled;
    }

    /**
     * Check for valid dates
     *
     * @return bool
     */
    public function isTemporal() {
        return isset($this->startDate) && isset($this->endDate);
    }

    /**
     * Get the start date
     *
     * @return DateTime|null
     */
    public function startDate() {
        return $this->startDate;
    }

    /**
     * Get the end date
     *
     * @return DateTime|null
     */
    public function endDate() {
        return $this->endDate;
    }

    /**
     * Get the duration
     *
     * @return \DateInterval|null
     */
    public function duration() {
        if ($this->isTemporal()) {
            return $this->startDate->diff($this->endDate, true);
        }
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
     * Ensure a date is not null
     *
     * @param  string        $type start or end
     * @param  DateTime|null $date the date to check
     * @throws EnablementDateException
     */
    private function guardNullDate($type, DateTime $date = null)
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
    private function guardValidRange(DateTime $start, DateTime $end)
    {
        if ($start >= $end) {
            throw EnablementDateException::invalidRange();
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $enabled   = $this->enabled;
        $endDate   = null;
        $startDate = null;

        if ($this->isTemporal()) {
            $endDate   = $this->endDate->format('U');
            $startDate = $this->startDate->format('U');
        }

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
        $this->enabled   = (bool) $data['enabled'];
        $this->endDate   = DateTime::createFromFormat('U', $data['endDate']) ?: null;
        $this->startDate = DateTime::createFromFormat('U', $data['startDate']) ?: null;
    }
}
