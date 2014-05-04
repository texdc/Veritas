<?php
/**
 * EnabledTraitTest.php
 *
 * @copyright 2014 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace VeritasTest\Identity;

use PHPUnit_Framework_TestCase as TestCase;
use VeritasTest\Identity\TestAsset\TestableEnabled;

class EnabledTraitTest extends TestCase
{
    public function testTraitExists()
    {
        $this->assertTrue(trait_exists('Veritas\Identity\EnabledTrait'));
    }

    public function testVerifyEnabledDoesNotRequireEnablement()
    {
        $subject = new TestableEnabled;
        $this->assertFalse($subject->verifyEnabled());
    }

    public function testVerifyEnabledChecksEnablementValidity()
    {
        $enablement = $this->getMockBuilder('Veritas\Identity\Enablement')
            ->disableOriginalConstructor()
            ->getMock();
        $enablement
            ->expects($this->once())
            ->method('validate')
            ->with(null)
            ->will($this->returnValue(true));

        $subject = new TestableEnabled($enablement);
        $this->assertTrue($subject->verifyEnabled());
    }
}
