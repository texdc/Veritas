<?php
/**
 * EnabledTrait.php
 *
 * @copyright 2015 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\veritas\identity;

use DateTime;

/**
 * Provides an {@link Enablement}
 *
 * @author George D. Cooksey, III
 */
trait EnabledTrait
{
    /**
     * @var Enablement
     */
    private $enablement;

    /**
     * Is the object enabled?
     *
     * @param  DateTime|null $onDate optional, defaults to 'now'
     * @return bool false if the enablement is set and not valid
     */
    public function isEnabled(DateTime $onDate = null)
    {
        return (!isset($this->enablement) || $this->enablement->isValid($onDate));
    }

    /**
     * Define an enablement
     *
     * @param    Enablement $anEnablement
     * @internal left abstract to afford events
     */
    abstract public function defineEnablement(Enablement $anEnablement);

    /**
     * Set the enablement
     *
     * @param  Enablement $enablement the enablement to set
     * @return void
     */
    private function setEnablement(Enablement $enablement)
    {
        $this->enablement = $enablement;
    }
}
