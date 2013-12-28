<?php
/**
 * EnabledTrait.php
 *
 * @copyright 2013 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace Veritas\Identity;

use DateTime;

/**
 * Provides an {@link Enablement}
 *
 * @author George D. Cooksey, III <texdc3@gmail.com>
 */
trait EnabledTrait
{

    /**
     * @var Enablement
     */
    private $enablement;


    /**
     * Define the enablement
     *
     * @param    Enablement $enablement
     * @internal Abstract to accomodate potential event mechanisms
     */
    abstract public function defineEnablement(Enablement $enablement);

    /**
     * Get the enablement
     *
     * @return Enablement
     */
    public function enablement()
    {
        return $this->enablement;
    }

    /**
     * Is the object enabled?
     *
     * @param  DateTime|null $onDate optional, defaults to 'now'
     * @return bool
     */
    public function isEnabled(DateTime $onDate = null)
    {
        return (isset($this->enablement) && $this->enablement->isValid($onDate));
    }

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
