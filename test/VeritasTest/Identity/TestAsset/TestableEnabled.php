<?php
/**
 * TestableEnabled.php
 *
 * @copyright 2014 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace VeritasTest\Identity\TestAsset;

use Veritas\Identity\Enablement;
use Veritas\Identity\EnabledInterface;

class TestableEnabled implements EnabledInterface
{
    use \Veritas\Identity\EnabledTrait;

    public function defineEnablement(Enablement $anEnablement) {
        $this->setEnablement($anEnablement);
    }
}
