<?php
/**
 * EnabledInterface.php
 *
 * @copyright 2015 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\veritas\identity;

use DateTime;

/**
 * Verify and define an {@link Enablement}
 *
 * @author George D. Cooksey, III
 */
interface EnabledInterface
{
    /**
     * Verify an enablement
     *
     * @param  DateTime|null $onDate optional, defaults to 'now'
     * @return bool false if the enablement is set and not valid
     * @see    Enablement::isValid()
     */
    public function isEnabled(DateTime $onDate = null);

    /**
     * Define an enablement
     *
     * @param Enablement $anEnablement
     */
    public function defineEnablement(Enablement $anEnablement);
}
