<?php
/**
 * IdentifiedTraitTest.php
 *
 * @copyright 2014 George D. Cooksey, III
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 */

namespace VeritasTest\Identity;

use PHPUnit_Framework_TestCase as TestCase;
use VeritasTest\Identity\TestAsset\IdentifiedAsset;

class IdentifiedTraitTest extends TestCase
{
    const TRAIT_NAME       = 'Veritas\Identity\IdentifiedTrait';
    const IDENTITY_CLASS   = 'Veritas\Identity\IdentityInterface';
    const CREDENTIAL_CLASS = 'Veritas\Identity\CredentialInterface';

    public function testTraitExists()
    {
        $this->assertTrue(trait_exists(self::TRAIT_NAME));
    }

    public function testHasIdentityComparesDefinedIdentifier()
    {
        $identity = $this->getMockForAbstractClass(self::IDENTITY_CLASS);
        $subject  = new IdentifiedAsset($identity);
        $this->assertTrue($subject->hasIdentity($identity));
    }

    public function testHasCredentialValidatesCredential()
    {
        $credential = $this->getMockForAbstractClass(self::CREDENTIAL_CLASS);
        $identity   = $this->getMockForAbstractClass(self::IDENTITY_CLASS);
        $identity
            ->expects($this->once())
            ->method('validate')
            ->with($credential)
            ->will($this->returnValue(true));
        $subject    = new IdentifiedAsset($identity);
        $this->assertTrue($subject->hasCredential($credential));
    }
}
