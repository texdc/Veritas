<?php
/**
 * TestableEnabled.php
 *
 * @copyright 2013 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace VeritasTest\Identity\TestAsset;

use Veritas\Identity\Enablement;

class TestableEnabled
{
    use \Veritas\Identity\EnabledTrait;

    public function defineEnablement(Enablement $enablement)
    {
        $this->setEnablement($enablement);
    }
}
