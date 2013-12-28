<?php
/**
 * EnabledTraitTest.php
 *
 * @copyright 2013 George D. Cooksey, III
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

    public function testEnablementReturnsEnablement()
    {
        $subject = new TestableEnabled;
        $enablement = $this->getEnablement();
        $subject->defineEnablement($enablement);
        $this->assertSame($enablement, $subject->enablement());
    }

    public function testIsEnabledChecksEnablementValidity()
    {
        $enablement = $this->getEnablement();
        $enablement
            ->expects($this->once())
            ->method('isValid')
            ->with(null)
            ->will($this->returnValue(true));

        $subject = new TestableEnabled;
        $subject->defineEnablement($enablement);
        $this->assertTrue($subject->isEnabled());
    }

    public function getEnablement()
    {
        return $this->getMockBuilder('Veritas\Identity\Enablement')
                    ->disableOriginalConstructor()
                    ->getMock();
    }
}
