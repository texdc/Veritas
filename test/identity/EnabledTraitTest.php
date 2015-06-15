<?php
/**
 * EnabledTraitTest.php
 *
 * @copyright 2015 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace texdc\veritas\test\identity;

use PHPUnit_Framework_TestCase as TestCase;
use texdc\veritas\identity\Enablement;

class EnabledTraitTest extends TestCase
{
    const TRAIT_FQCN = 'texdc\veritas\identity\EnabledTrait';

    public function testTraitExists()
    {
        $this->assertTrue(trait_exists(self::TRAIT_FQCN));
    }

    public function testIsEnabledDoesNotRequireEnablement()
    {
        $subject = $this->getMockForTrait(self::TRAIT_FQCN);
        $this->assertTrue($subject->isEnabled());
    }

    public function testIsEnabledChecksDefinedEnablement()
    {
        $subject = new asset\TestableEnabled();
        $subject->defineEnablement(new Enablement(false));
        $this->assertFalse($subject->isEnabled());
    }
}
