<?php
/**
 * Enablement.php
 *
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @copyright 2013 George D. Cooksey, III
 */

namespace Veritas\Identity;

use DateTime;
use JsonSerializable;
use Serializable;

/**
 * Defines an enabled state for a given range of dates
 *
 * @link   https://github.com/VaughnVernon/IDDD_Samples
 * @author George D. Cooksey, III <texdc3@gmail.com>
 */
class Enablement implements Serializable, JsonSerializable
{

    /**#@+
     * Error constants
     * @var string
     */
    const ERROR_MISSING_STARTDATE = 'The start date must be provided';
    const ERROR_MISSING_ENDDATE   = 'The end date must be provided';
    const ERROR_INVALID_DATES     = 'The start date must be before the end date';
    /**#@- */

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
        $this->setEnabled($enabled);
        if (isset($startDate) || isset($endDate)) {
            $this->assertNotNull($startDate, static::ERROR_MISSING_STARTDATE);
            $this->assertNotNull($endDate, static::ERROR_MISSING_ENDDATE);
            $this->assertFalse($startDate > $endDate, static::ERROR_INVALID_DATES);

            $this->setEndDate($endDate);
            $this->setStartDate($startDate);
        }
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return $this->enabled;
    }

    /**
     * @param  DateTime|null $onDate optional, defaults to 'now'
     * @return bool
     */
    public function isExpired(DateTime $onDate = null)
    {
        if (isset($this->startDate) && isset($this->endDate)) {
            $onDate = $onDate ?: new DateTime;
            return ($onDate < $this->startDate || $onDate > $this->endDate);
        }
        return false;
    }

    /**
     * @param  DateTime|null $onDate optional, defaults to 'now'
     * @return bool
     */
    public function isValid(DateTime $onDate = null)
    {
        return ($this->isEnabled() && !$this->isExpired($onDate));
    }

    /**
     * @return DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * @return DateTime
     */
    public function getEndDate()
    {
        return $this->endDate;
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
        $this->setEnabled($data['enabled']);
        $this->setEndDate($data['endDate']);
        $this->setStartDate($data['startDate']);
    }

    /**
     * @param bool $enabled
     */
    private function setEnabled($enabled)
    {
        $this->enabled = (bool) $enabled;
    }

    /**
     * @param DateTime|null $endDate
     */
    private function setEndDate(DateTime $endDate = null)
    {
        $this->endDate = $endDate;
    }

    /**
     * @param DateTime|null $startDate
     */
    private function setStartDate(DateTime $startDate = null)
    {
        $this->startDate = $startDate;
    }

    /**
     * @param mixed  $value
     * @param string $message
     * @throws \InvalidArgumentException
     */
    private function assertNotNull($value, $message)
    {
        if (is_null($value)) {
            throw new \InvalidArgumentException($message);
        }
    }

    /**
     * @param bool   $statement
     * @param string $message
     * @throws \DomainException
     */
    private function assertFalse($statement, $message)
    {
        if ($statement !== false) {
            throw new \DomainException($message);
        }
    }
}
