<?php
/**
 * EnabledTrait.php
 *
 * @copyright 2014 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Veritas\Identity;

use DateTime;

/**
 * Provides an {@link Enablement}
 *
 * @author George D. Cooksey, III
 */
trait EnabledTrait
{
    /**
     * Is the object enabled?
     *
     * @param  DateTime|null $onDate optional, defaults to 'now'
     * @return bool false if the enablement is not set or not valid
     */
    public function verifyEnabled(DateTime $onDate = null)
    {
        return (isset($this->enablement) && $this->enablement->validate($onDate));
    }

    /**
     * Set the enablement
     *
     * @param  Enablement|null $enablement the enablement to set
     * @return void
     */
    private function setEnablement(Enablement $enablement = null)
    {
        $this->enablement = $enablement;
    }
}
