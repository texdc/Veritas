<?php
/**
 * EnabledTraitTest.php
 *
 * @copyright 2014 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace VeritasTest\Identity;

use PHPUnit_Framework_TestCase as TestCase;
use Veritas\Identity\Enablement;
use VeritasTest\Identity\TestAsset\TestableEnabled;

class EnabledTraitTest extends TestCase
{
    const TRAIT_FQCN = 'Veritas\Identity\EnabledTrait';

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
        $subject = new TestableEnabled();
        $subject->defineEnablement(new Enablement(false));
        $this->assertFalse($subject->isEnabled());
    }
}
