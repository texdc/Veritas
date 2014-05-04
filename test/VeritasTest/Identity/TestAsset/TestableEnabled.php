<?php
/**
 * TestableEnabled.php
 *
 * @copyright 2014 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace VeritasTest\Identity\TestAsset;

use Veritas\Identity\Enablement;

class TestableEnabled
{
    use \Veritas\Identity\EnabledTrait;

    private $enablement;

    public function __construct(Enablement $enablement = null)
    {
        $this->setEnablement($enablement);
    }
}
