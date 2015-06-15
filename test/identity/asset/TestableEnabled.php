<?php
/**
 * TestableEnabled.php
 *
 * @copyright 2015 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\veritas\test\identity\asset;

use texdc\veritas\identity\Enablement;
use texdc\veritas\identity\EnabledInterface;

class TestableEnabled implements EnabledInterface
{
    use \texdc\veritas\identity\EnabledTrait;

    public function defineEnablement(Enablement $anEnablement)
    {
        $this->setEnablement($anEnablement);
    }
}
